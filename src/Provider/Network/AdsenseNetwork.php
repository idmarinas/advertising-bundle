<?php

/**
 * Copyright 2021-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 20:57
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    AdsenseNetwork.php
 * @date    13/02/2021
 * @time    17:09
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   0.1.0
 */

namespace Idm\Bundle\Advertising\Provider\Network;

use ArrayObject;
use Idm\Bundle\Advertising\Enums\Provider\Network\AdsenseAdTypeEnum;
use Idm\Bundle\Advertising\Event\NetworkEvent;
use Idm\Bundle\Advertising\Provider\Banner\AbstractBanner;
use Idm\Bundle\Advertising\Provider\Banner\AdsenseBanner;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

final class AdsenseNetwork extends AbstractNetwork
{
	private string $client;

	public function getScriptUrl (string $type): string
	{
		return match ($type) {
			'search' => 'https://cse.google.com/cse.js?cx=' . str_replace('ca-pub-', 'partner-pub-', $this->getClient()),
			default  => 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=' . $this->getClient(),
		};
	}

	public function getBanner (string $bannerName): ?AbstractBanner
	{
		if (!$this->isNetworkEnabled()) {
			return null;
		}

		/** @var AdsenseBanner $banner */
		$banner = parent::getBanner($bannerName);

		if (null !== $banner) {
			$type = $banner->getType();
			$url = $this->getScriptUrl($type->value) . ($type === AdsenseAdTypeEnum::Search ? ':' . $banner->getSlot() : '');
			$banner->setUrl($url);
		}

		$event = new NetworkEvent();
		$event->setBanner($banner);
		$this->eventDispatcher->dispatch($event, NetworkEvent::NETWORK_GET_BANNER_POST);

		return $event->getBanner();
	}

	/**
	 * @inheritdoc
	 * @throws ExceptionInterface
	 */
	public function configureBanners (array $banners): self
	{
		$this->banners = new ArrayObject();

		foreach ($banners as $banner => $config) {
			$config['name'] = $banner;
			$obj = $this->denormalizer->denormalize($config, AdsenseBanner::class, 'array');
			$obj->setClient($this->getClient());
			$this->banners->offsetSet($banner, $obj);
		}

		return $this;
	}

	public function getClient (): string
	{
		return $this->client;
	}

	public function setClient (string $client): void
	{
		$this->client = $client;
	}
}
