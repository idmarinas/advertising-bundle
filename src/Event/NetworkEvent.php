<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 10/03/2025, 22:40
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    NetworkEvent.php
 * @date    10/03/2025
 * @time    22:28
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Event;

use Idm\Bundle\Advertising\Provider\Banner\AbstractBanner;
use Symfony\Contracts\EventDispatcher\Event;

final class NetworkEvent extends Event
{
	public const NETWORK_GET_BANNER_POST = 'idm_advertising.network.get_banner.post';
	public ?AbstractBanner $banner = null;

	public function getBanner (): ?AbstractBanner
	{
		return $this->banner;
	}

	public function setBanner (?AbstractBanner $banner): void
	{
		$this->banner = $banner;
	}

}
