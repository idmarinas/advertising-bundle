<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 16:33
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    AdvertisingExtension.php
 * @date    07/03/2025
 * @time    17:31
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Twig\Extension;

use Idm\Bundle\Advertising\Twig\Runtime\BannerRuntime;
use Idm\Bundle\Advertising\Twig\Runtime\ScriptsRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class AdvertisingExtension extends AbstractExtension
{
	public function getFunctions (): array
	{
		return [
			new TwigFunction('idm_advertising_banner', [BannerRuntime::class, 'showBanner'], ['is_safe' => ['html']]),
			new TwigFunction('idm_advertising_scripts', [ScriptsRuntime::class, 'showScripts'], ['is_safe' => ['html']]),
		];
	}
}
