<?php
/**
 * Copyright 2021-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 10/03/2026, 22:22
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    IdmAdvertisingBundle.php
 * @date    13/02/2021
 * @time    17:09
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   0.1.0
 */

namespace Idm\Bundle\Advertising;

use Idm\Bundle\Advertising\Provider\Network\NetworkInterface;
use InvalidArgumentException;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\UX\TwigComponent\TwigComponentBundle;

final class IdmAdvertisingBundle extends AbstractBundle implements CompilerPassInterface
{
	private array $extensionConfig;

	public function build(ContainerBuilder $container): void
	{
		$container->addCompilerPass($this);
	}

	public function configure(DefinitionConfigurator $definition): void
	{
		$definition->import(dirname(__DIR__).'/config/definitions.php');
	}

	public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
	{
		$this->extensionConfig = $config;
		$container->import(dirname(__DIR__).'/config/services.php');
		$container->import(dirname(__DIR__).'/config/twig.php');
	}

	public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
	{
		if ($builder::willBeAvailable('symfony/ux-twig-component', TwigComponentBundle::class, ['symfony/twig-bundle'])) {
			$container->import(dirname(__DIR__).'/config/twig_component.php');
		}
	}

	public function process(ContainerBuilder $container): void
	{
		$providerHub = $container->findDefinition('.idm_advertising.provider_hub');
		$providerHub->addMethodCall('disableAdvertising'); // Disabled by default

		foreach ($this->extensionConfig as $network => $settings) {
			if (!isset($settings['service_network'])) {
				continue;
			}

			$definition = $container->findDefinition($settings['service_network']);
			$class = $definition->getClass();

			if (!is_subclass_of($class, NetworkInterface::class)) {
				throw new InvalidArgumentException(
					sprintf(
						'Somehow the "%s" network is not implement the interface %s.',
						$settings['service_network'],
						NetworkInterface::class
					)
				);
			}

			$definition->addMethodCall('configure', [$settings]);
			$definition->addMethodCall('disableNetwork'); // Disabled by default

			if ($settings['enabled']) {
				$providerHub->addMethodCall('enableAdvertising');
				$definition->addMethodCall('enableNetwork');
			}
			$providerHub->addMethodCall('setNetwork', [$network, $definition]);
		}
	}
}
