<?php
/**
 * Copyright 2021-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 14:35
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    NetworkInterface.php
 * @date    13/02/2021
 * @time    17:09
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   0.1.0
 */

namespace Idm\Bundle\Advertising\Provider\Network;

use Idm\Bundle\Advertising\Provider\Banner\AbstractBanner;

interface NetworkInterface
{
	public function getBanner (string $bannerName): ?AbstractBanner;

	public function getScriptUrl (string $type): string;

	/**
	 * Configure network
	 */
	public function configure (array $config): self;

	/**
	 * Configure banners of network
	 */
	public function configureBanners (array $banners): self;

	/**
	 * Network is enable only if Network is enabled and Advertising is enabled
	 */
	public function isNetworkEnabled (): bool;

	public function enableNetwork (): self;

	public function disableNetwork (): self;
}
