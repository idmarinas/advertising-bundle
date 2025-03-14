<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 16:54
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    InvalidNetworkTest.php
 * @date    14/03/2025
 * @time    16:01
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Tests\Configuration;

use App\Kernel;
use Idm\Bundle\Advertising\Provider\ProviderHub;
use Idm\Bundle\Advertising\Tests\CreateKernelTestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class InvalidNetworkTest extends KernelTestCase
{
	use InteractsWithTwigComponents;
	use CreateKernelTestCaseTrait;

	public function testInvalidNetwork ()
	{
		$this->expectExceptionMessage(
			'Somehow the "App\Provider\Network\InvalidNetwork" network is not implement the interface Idm\Bundle\Advertising\Provider\Network\NetworkInterface.'
		);

		self::bootKernel([
			'config' => static function (Kernel $kernel) {
				$kernel->addExtraConfig(dirname(__DIR__) . '/config/config_invalid_network.php');
			},
		]);
	}

	public function testNotNetworks ()
	{
		self::ensureKernelShutdown();
		self::bootKernel();

		$provider = self::getContainer()->get(ProviderHub::class);

		$this->assertFalse($provider->isAdvertisingEnabled());

		$this->assertNull($provider->getNetwork('adsense'));
		$this->assertNull($provider->getNetwork('cpmstar'));
		$this->assertNull($provider->getNetwork('generic'));
	}
}
