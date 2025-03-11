<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 20:57
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    BannerRuntime.php
 * @date    07/03/2025
 * @time    17:32
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Twig\Runtime;

use Idm\Bundle\Advertising\Event\TwigBannerEvent;
use Idm\Bundle\Advertising\Provider\Network\AbstractNetwork;
use Idm\Bundle\Advertising\Provider\ProviderHub;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Twig\Extension\RuntimeExtensionInterface;

final readonly class BannerRuntime implements RuntimeExtensionInterface
{
	public function __construct (private EventDispatcherInterface $eventDispatcher, private ProviderHub $providerHub) {}

	public function showBanner (string $networkName, string $bannerName): string
	{
		/** @var AbstractNetwork $network */
		$network = $this->providerHub->getNetwork($networkName);

		if (!$network?->isNetworkEnabled()) {
			return '';
		}

		$banner = $network->getBanner($bannerName);

		$event = new TwigBannerEvent();
		$event->setBanner($banner);
		$this->eventDispatcher->dispatch($event, TwigBannerEvent::TWIG_SHOW_BANNER_POST);

		$banner = $event->getBanner();

		if (null == $banner || $banner->isIgnoredBanner()) {
			return '';
		}

		$this->providerHub->setScriptUrls($networkName, $banner->getUrl());

		return $banner->getTemplate();
	}

	public function render (array $args = []): string
	{
		$network = $args['network'];
		$banner = $args['banner'];

		return $this->showBanner($network, $banner);
	}
}
