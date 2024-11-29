<?php
/**
 * Copyright 2021-2024 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 29/11/24, 19:40
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    IntegrationTest.php
 * @date    13/02/2021
 * @time    17:09
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   0.1.0
 */

namespace Idm\Bundle\Advertising\Tests\Extension;

use Idm\Bundle\Advertising\IdmAdvertisingBundle;
use Idm\Bundle\Advertising\Twig\Extension\AdvertisingGeneric;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
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
	public function getExtensions (): array
	{
		$container = $this->getContainer();
		/** @var $registry \Idm\Bundle\Advertising\Provider\NetworkRegistry */
		$registry = $container->get('idm_advertising.networks.registry');

		return [
			new AdvertisingGeneric($registry, new EventDispatcher()),
		];
	}

	public static function getFixturesDirectory (): string
	{
		return __DIR__ . '/Fixtures/';
	}

	protected function getContainer (): ContainerInterface
	{
		$kernel = new ExtensionTestingKernel();
		$kernel->boot();

		return $kernel->getContainer();
	}
}

class ExtensionTestingKernel extends Kernel
{
	public function __construct ()
	{
		parent::__construct('test', true);
	}

	public function registerBundles (): iterable
	{
		return [
			new IdmAdvertisingBundle(),
		];
	}

	public function registerContainerConfiguration (LoaderInterface $loader): void
	{
		$loader->load(function (ContainerBuilder $container) {
			$container->loadFromExtension('idm_advertising', [
				'enable'   => true, // Enable/disable advertising bundle
				'networks' => [
					// Default configuration for AdSense Advertising
					'adsense' => [
						'type'    => 'adsense',
						'enable'  => true, // Enable/disable advertising provider
						'client'  => 'ca-pub-XXXXXXX11XXX9', // "data-ad-client" ca-pub-XXXXXXX11XXX9
						// Banners of ads (As many as you need with the same format)
						'banners' => [
							'ad_header' => [
								'style'      => 'display:block',
								// style="" tag in <ins>
								'slot'       => 4_555_454,
								//  "data-ad-slot" Slot ID of Ad block 8XXXXX1
								'format'     => 'auto',
								// "data-ad-format" Values: "rectangle", "vertical" or "horizontal"
								'responsive' => true,
								// "data-full-width-responsive"
							],
						],
					],
				],
			]);
		});
	}
}