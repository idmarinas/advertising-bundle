<?php

/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 12/03/2025, 11:45
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    BundleInitializationTest.php
 * @date    07/03/2025
 * @time    15:31
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   0.1.0
 */

namespace Idm\Bundle\Advertising\Tests;

use Idm\Bundle\Advertising\Provider\Network\NetworkInterface;
use Idm\Bundle\Advertising\Provider\ProviderHub;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class BundleInitializationTest extends KernelTestCase
{
	public function testInitBundle (): void
	{
		// Boot the kernel.
		self::bootKernel();

		// Get the container
		$container = self::getContainer();

		$this->assertTrue(in_array('.idm_advertising.provider_hub', $container->getRemovedIds()));
		$service = $container->get(ProviderHub::class);
		$this->assertInstanceOf(ProviderHub::class, $service);

		$this->assertTrue($container->has('idm_advertising.network.adsense'));
		$service = $container->get('idm_advertising.network.adsense');
		$this->assertInstanceOf(NetworkInterface::class, $service);

		$this->assertTrue($container->has('idm_advertising.network.cpmstar'));
		$service = $container->get('idm_advertising.network.cpmstar');
		$this->assertInstanceOf(NetworkInterface::class, $service);
	}
}
