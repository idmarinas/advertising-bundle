<?php

/**
 * Copyright 2021-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 18:38
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    TwigBannerEvent.php
 * @date    01/07/2021
 * @time    18:56
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   0.2.0
 */

namespace Idm\Bundle\Advertising\Event;

use Idm\Bundle\Advertising\Provider\Banner\AbstractBanner;
use Symfony\Contracts\EventDispatcher\Event;

final class TwigBannerEvent extends Event
{
	/** Event that occurs after the banner is selected. */
	public const TWIG_SHOW_BANNER_POST = 'idm_advertising.twig.show_banner.post';

	private ?AbstractBanner $banner = null;

	/** Get banner selected. */
	public function getBanner (): ?AbstractBanner
	{
		return $this->banner;
	}

	/** Set or reemplace banner selected. */
	public function setBanner (?AbstractBanner $banner): self
	{
		$this->banner = $banner;

		return $this;
	}
}
