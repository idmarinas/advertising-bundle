<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 16:20
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
use Idm\Bundle\Advertising\Tests\CreateKernelTestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class InvalidNetworkTest extends KernelTestCase
{
	use InteractsWithTwigComponents;
	use CreateKernelTestCaseTrait;

	protected static function bootKernel (array $options = []): KernelInterface
	{
		$options = $options + [
				'config' => static function (Kernel $kernel) {
					$kernel->addExtraConfig(dirname(__DIR__) . '/config/invalid_network_config.php');
				},
			];

		return parent::bootKernel($options);
	}

	public function testInvalidNetwork ()
	{
		$this->expectExceptionMessage(
			'Somehow the "App\Provider\Network\InvalidNetwork" network is not implement the interface Idm\Bundle\Advertising\Provider\Network\NetworkInterface.'
		);
		self::getContainer();
	}
}
