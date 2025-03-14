<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 18:34
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    BannerTwigTest.php
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
use Idm\Bundle\Advertising\Provider\ProviderHub;
use Idm\Bundle\Advertising\Tests\CreateKernelTestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;
use Twig\Environment;

class BannerTwigTest extends KernelTestCase
{
	use CreateKernelTestCaseTrait;

	protected static function bootKernel (array $options = []): KernelInterface
	{
		$options = $options + [
				'config' => static function (Kernel $kernel) {
					$kernel->addExtraConfig(dirname(__DIR__, 2) . '/config/idm_advertising.php');
				},
			];

		return parent::bootKernel($options);
	}

	public function testRenderTwigComponent (): void
	{
		$tpl = '<twig:IdmAdvertising:Banner network="adsense" banner="main" />';
		/** @var Environment $twig */
		$twig = self::getContainer()->get('twig');
		$output = $twig->createTemplate($tpl)->render();

		$expected = <<<'EXPECTED'
<ins data-ad-client="ca-pub-XXXXXXX11XXX9" data-ad-slot="54555454" data-full-width-responsive="false" data-ad-format="auto" class="adsbygoogle" style="display:block;"></ins>
<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
EXPECTED;

		$this->assertSame($expected, $output);
	}

	public function testAdvertisingDisabled ()
	{
		self::getContainer()->get(ProviderHub::class)->disableAdvertising();

		$tpl = <<<'TPL'
<twig:IdmAdvertising:Scripts network="adsense" />
TPL;

		/** @var Environment $twig */
		$twig = self::getContainer()->get('twig');
		$output = $twig->createTemplate($tpl)->render();

		$expected = <<<'EXPECTED'
EXPECTED;

		$this->assertSame($expected, $output);
	}
}
