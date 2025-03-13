<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 13/03/2025, 12:55
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    BannerTest.php
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
use Idm\Bundle\Advertising\Twig\Component\Banner;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class BannerTest extends KernelTestCase
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
			name: Banner::class,
			data: ['network' => 'adsense', 'banner' => 'ad_header'],
		);

		$this->assertInstanceOf(Banner::class, $component);
		$this->assertSame('ad_header', $component->banner);
		$this->assertSame('adsense', $component->network);
	}

	/** @dataProvider invalidOptionsDataProvider */
	public function testInvalidOptions (array $opts, string $expected): void
	{
		$this->expectExceptionMessage($expected);
		$this->mountTwigComponent(
			name: Banner::class,
			data: $opts,
		);
	}

	private function invalidOptionsDataProvider (): iterable
	{
		yield [
			['network' => 'invalid_network', 'banner' => 'ad_header'],
			'The option "network" with value "invalid_network" is invalid.',
		];

		yield [
			['network' => 'adsense', 'banner' => true],
			'The option "banner" with value true is expected to be of type "string", but is of type "bool".',
		];

		yield [
			['network' => 'adsense', 'banner' => []],
			'The option "banner" with value array is expected to be of type "string", but is of type "array".',
		];

		yield [
			['network' => 'adsense', 'banner' => new stdClass()],
			'The option "banner" with value stdClass is expected to be of type "string", but is of type "stdClass".',
		];

		yield [
			['network' => 'adsense', 'banner' => 85.69745],
			'The option "banner" with value 85.69745 is expected to be of type "string", but is of type "float".',
		];
	}

}
