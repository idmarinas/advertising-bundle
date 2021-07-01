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

namespace Idm\Bundle\AdvertisingBundle\Tests\Extension;

use Idm\Bundle\AdvertisingBundle\IdmAdvertisingBundle;
use Idm\Bundle\AdvertisingBundle\Twig\Extension\AdvertisingGeneric;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Kernel;
use Twig\Test\IntegrationTestCase;

/**
 * Test Twig Extensions.
 *
 * @internal
 */
class IntegrationTest extends IntegrationTestCase
{
    public function getExtensions()
    {
        $container = $this->getContainer();

        return [
            new AdvertisingGeneric($container->get('idm_advertising.networks.registry'), new EventDispatcher()),
        ];
    }

    public function getFixturesDir()
    {
        return __DIR__.'/Fixtures/';
    }

    protected function getContainer()
    {
        $kernel = new ExtensionTestingKernel();
        $kernel->boot();

        return $kernel->getContainer();
    }
}

class ExtensionTestingKernel extends Kernel
{
    public function __construct()
    {
        parent::__construct('test', true);
    }

    public function registerBundles()
    {
        return [
            new IdmAdvertisingBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container)
        {
            $container->loadFromExtension('idm_advertising', [
                'enable'   => true, // Enable/disable advertising bundle
                'networks' => [
                    'adsense' => [ // Default configuration for AdSense Advertising
                        'type'    => 'adsense',
                        'enable'  => true, // Enable/disable advertising provider
                        'client'  => 'ca-pub-XXXXXXX11XXX9', // "data-ad-client" ca-pub-XXXXXXX11XXX9
                        'banners' => [ // Banners of ads (As many as you need with the same format)
                            'ad_header' => [
                                'style'      => 'display:block', // style="" tag in <ins>
                                'slot'       => 4555454, //  "data-ad-slot" Slot ID of Ad block 8XXXXX1
                                'format'     => 'auto', // "data-ad-format" Values: "rectangle", "vertical" or "horizontal"
                                'responsive' => true, // "data-full-width-responsive"
                            ],
                        ],
                    ],
                ],
            ]);
        });
    }
}
