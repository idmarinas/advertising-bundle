<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 17:30
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    GenericNetworkTest.php
 * @date    14/03/2025
 * @time    16:50
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Tests\Configuration;

use App\Kernel;
use App\Provider\Banner\GenericBanner;
use App\Provider\Network\GenericNetwork;
use Idm\Bundle\Advertising\Provider\ProviderHub;
use Idm\Bundle\Advertising\Tests\CreateKernelTestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GenericNetworkTest extends KernelTestCase
{
	use CreateKernelTestCaseTrait;

	public function testNetwork ()
	{
		self::bootKernel([
			'config' => static function (Kernel $kernel) {
				$kernel->addExtraConfig(dirname(__DIR__) . '/config/config_generic_network.php');
			},
		]);

		$provider = static::$kernel->getContainer()->get(ProviderHub::class);
		$network = $provider->getNetwork('generic');

		$this->assertInstanceOf(GenericNetwork::class, $network);
		$banner = $network->getBanner('main');
		$this->assertInstanceOf(GenericBanner::class, $banner);

		$this->assertEquals('main', $banner->getName());

		$this->assertEquals('<div data-enum="enum"><span>Ad Generic</span></div>', $banner->getTemplate());

		$banner->setIgnoredBanner(true);

		$this->assertTrue($banner->isIgnoredBanner());

		$nonceStyle = uniqid();
		$banner->setNonceStyle($nonceStyle);

		$this->assertEquals($nonceStyle, $banner->getNonceStyle());

		$nonceScript = uniqid();
		$banner->setNonceScript($nonceScript);

		$this->assertEquals($nonceScript, $banner->getNonceScript());
	}
}
