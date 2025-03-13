<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 13/03/2025, 19:50
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    ScriptsTwigTest.php
 * @date    13/03/2025
 * @time    18:54
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Tests\Twig\Component;

use App\Kernel;
use Idm\Bundle\Advertising\Tests\KernelTestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;
use Twig\Environment;

class ScriptsTwigTest extends KernelTestCase
{
	use KernelTestCaseTrait;

	public static function setUpBeforeClass (): void {}

	protected static function bootKernel (array $options = []): KernelInterface
	{
		$options = $options + [
				'config' => static function (Kernel $kernel) {
					$kernel->addExtraConfig(dirname(__DIR__, 2) . '/config/idm_advertising.php');
				},
			];

		return parent::bootKernel($options);
	}

	public function testRenderTwigComponentEmpty (): void
	{
		$tpl = <<<'TPL'
<twig:IdmAdvertising:Show:Scripts network="adsense" />
TPL;

		/** @var Environment $twig */
		$twig = self::getContainer()->get('twig');
		$output = $twig->createTemplate($tpl)->render();

		$expected = <<<'EXPECTED'
EXPECTED;

		$this->assertSame($expected, $output);
	}

	public function testRenderTwigComponent (): void
	{
		$tpl = <<<'TPL'
<twig:IdmAdvertising:Show:Banner network="adsense" banner="main" />
<twig:IdmAdvertising:Show:Scripts network="adsense" />
TPL;

		/** @var Environment $twig */
		$twig = self::getContainer()->get('twig');
		$output = $twig->createTemplate($tpl)->render();

		$expected = <<<'EXPECTED'
<ins data-ad-client="ca-pub-XXXXXXX11XXX9" data-ad-slot="54555454" data-full-width-responsive="false" data-ad-format="auto" class="adsbygoogle" style="display:block;"></ins>
<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
<script async crossorigin="anonymous" src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXX11XXX9"></script>
EXPECTED;

		$this->assertSame($expected, $output);
	}
}
