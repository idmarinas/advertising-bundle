<?php

/**
 * Copyright 2023-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 21:14
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    CpmStarNetwork.php
 * @date    17/08/2023
 * @time    16:52
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.6.0
 */

namespace Idm\Bundle\Advertising\Provider\Network;

use ArrayObject;
use Idm\Bundle\Advertising\Event\NetworkEvent;
use Idm\Bundle\Advertising\Provider\Banner\AbstractBanner;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

final class CpmStarNetwork extends AbstractNetwork
{
	public function getBanner (string $bannerName): ?AbstractBanner
	{
		if (!$this->isNetworkEnabled()) {
			return null;
		}

		$banner = parent::getBanner($bannerName);

		$event = new NetworkEvent();
		$event->setBanner($banner);
		$this->eventDispatcher->dispatch($event, NetworkEvent::NETWORK_GET_BANNER_POST);

		return $event->getBanner();
	}

	/**
	 * @throws ExceptionInterface
	 */
	public function configureBanners (array $banners): NetworkInterface
	{
		$this->banners = new ArrayObject();

		foreach ($banners as $banner => $config) {
			$config['name'] = $banner;
			$obj = $this->denormalizer->denormalize($config, CpmStarNetwork::class, 'array');
			$this->banners->offsetSet($banner, $obj);
		}

		return $this;
	}

	public function getScriptUrl (string $type): string
	{
		return '';
	}
}
