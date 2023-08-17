<?php

/**
 * This file is part of Bundle "IDM Advertising Bundle".
 *
 * @see https://github.com/idmarinas/advertising-bundle
 *
 * @license https://github.com/idmarinas/advertising-bundle/blob/master/LICENSE.txt
 * @author IDMarinas
 *
 * @since 0.1.0
 */

namespace Idm\Bundle\AdvertisingBundle\DependencyInjection;

use Idm\Bundle\AdvertisingBundle\DependencyInjection\Network\AdsenseNetworkConfiguration;
use Idm\Bundle\AdvertisingBundle\DependencyInjection\Network\GenericNetworkConfiguration;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class IdmAdvertisingExtension extends ConfigurableExtension
{
    private const SUPPORTED_NETWORK_TYPES = [
        'generic' => GenericNetworkConfiguration::class,
        'adsense' => AdsenseNetworkConfiguration::class,
        'cpmstar' => CpmStarNetworkConfiguration::class,
    ];
    protected $configurators = [];

    public function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(\dirname(__DIR__).'/Resources/config'));

        $loader->load('services.php');
        $loader->load('twig.php');

        $networks = $mergedConfig['networks'];

        $networksRegistry = [];
        //-- Configure all networks
        foreach ($networks as $name => $networkConfig)
        {
            if ( ! isset($networkConfig['type']))
            {
                throw new InvalidConfigurationException(\sprintf(
                    'Your "idm_advertising.networks.%s" config entry is missing the "type" key.',
                    $name
                ));
            }

            $provider = $networkConfig['type'];
            unset($networkConfig['type']);

            if ( ! isset(self::SUPPORTED_NETWORK_TYPES[$provider]))
            {
                throw new InvalidConfigurationException(\sprintf(
                    'The "idm_advertising.networks" config "type" key "%s" is not supported. We support (%s)',
                    $provider,
                    \implode(', ', self::SUPPORTED_NETWORK_TYPES)
                ));
            }

            //-- Process configuration
            $tree = new TreeBuilder('idm_advertising/networks/'.$name);
            $node = $tree->getRootNode();

            $this->buildConfigurationForProviderType($node, $provider);

            $processor = new Processor();
            $config    = $processor->process($tree->buildTree(), [$networkConfig]);

            $networksRegistry[$name] = $this->configureNetworkAndService($container, $config, $mergedConfig['enable']);
        }

        $container->getDefinition('idm_advertising.networks.registry')
            ->replaceArgument(1, $networksRegistry)
        ;
    }

    /**
     * @param array $config      Configuration for Network
     * @param bool  $advertising enable Advertisin bundle enabled/disabled
     */
    private function configureNetworkAndService(
        ContainerBuilder $container,
        array $config,
        bool $advertisingEnable
    ): string {
        $definition = $container->getDefinition($config['service_network']);
        $definition->addMethodCall('configure', [$config]);

        $definition->addMethodCall('disableAdvertising'); //-- Disabled by default

        if ($advertisingEnable)
        {
            $definition->addMethodCall('enableAdvertising');
        }

        return $config['service_network'];
    }

    private function buildConfigurationForProviderType(NodeDefinition $node, $provider): void
    {
        $optionsNode = $node
            ->fixXmlConfig('banner')
            ->children()
        ;

        /*
         *
         * crearlo como el configuration.php
         * para poder usarlos en los test
         */

        $optionsNode
            ->booleanNode('enable')
            ->defaultFalse()
            ->end()
        ;

        // allow the specific provider to add more options
        $this->getConfigurator($provider)
            ->buildConfiguration($optionsNode)
        ;

        $optionsNode->end();
    }

    /**
     * @param string $type
     * @param mixed  $provider
     *
     * @return ProviderConfiguratorInterface
     */
    private function getConfigurator($provider)
    {
        if ( ! isset($this->configurators[$provider]))
        {
            $class = self::SUPPORTED_NETWORK_TYPES[$provider];

            $this->configurators[$provider] = new $class();
        }

        return $this->configurators[$provider];
    }
}
