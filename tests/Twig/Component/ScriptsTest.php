<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 12/03/2025, 16:25
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    ScriptsTest.php
 * @date    12/03/2025
 * @time    16:00
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Tests\Twig\Component;

use App\Kernel;
use Idm\Bundle\Advertising\Twig\Component\Scripts;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class ScriptsTest extends KernelTestCase
{
	use InteractsWithTwigComponents;

	protected static function createKernel (array $options = []): KernelInterface
	{
		/** @var Kernel $kernel */
		$kernel = parent::createKernel($options);
		$kernel->handleOptions($options);

		return $kernel;
	}

	protected static function bootKernel (array $options = []): KernelInterface
	{
		$options = $options + [
				'config' => static function (Kernel $kernel) {
					$kernel->addExtraConfig(dirname(__DIR__) . '/Extension/idm_advertising.php');
				},
			];

		return parent::bootKernel($options);
	}

	public function testComponentMount (): void
	{
		$component = $this->mountTwigComponent(
			name: Scripts::class,
			data: ['network' => 'adsense'],
		);

		$this->assertInstanceOf(Scripts::class, $component);
		$this->assertSame('adsense', $component->network);
	}
}
