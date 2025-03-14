<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 13:28
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    AdsenseTrait.php
 * @date    08/03/2025
 * @time    12:56
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Provider\ProviderHub;

use Idm\Bundle\Advertising\Provider\Network\AdsenseNetwork;

trait AdsenseTrait
{
	private AdsenseNetwork $adsenseNetwork;

	public function getAdsenseNetwork (): ?AdsenseNetwork
	{
		if (!isset($this->adsenseNetwork)) {
			return null;
		}

		return $this->adsenseNetwork;
	}

	public function setAdsenseNetwork (AdsenseNetwork $network): self
	{
		$this->adsenseNetwork = $network;

		return $this;
	}
}
