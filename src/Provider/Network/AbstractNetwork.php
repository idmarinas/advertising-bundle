<?php
/**
 * Copyright 2021-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 14:35
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    AbstractNetwork.php
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
use Idm\Bundle\Advertising\Provider\Banner\AbstractBanner;
use Idm\Bundle\Advertising\Provider\ProviderHub;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

abstract class AbstractNetwork implements NetworkInterface
{
	protected ArrayObject $banners;
	private bool          $networkEnabled;

	public function __construct (
		protected readonly ProviderHub              $provider,
		protected readonly DenormalizerInterface    $denormalizer,
		protected readonly EventDispatcherInterface $eventDispatcher,
	) {}

	public function getBanner (string $bannerName): ?AbstractBanner
	{
		if ($this->banners->offsetExists($bannerName)) {
			return $this->banners->offsetGet($bannerName);
		}

		return null;
	}

	public function isNetworkEnabled (): bool
	{
		return $this->provider->isAdvertisingEnabled() && $this->networkEnabled;
	}

	public function enableNetwork (): self
	{
		$this->networkEnabled = true;

		return $this;
	}

	public function disableNetwork (): self
	{
		$this->networkEnabled = false;

		return $this;
	}

	/**
	 * @inheritdoc
	 * @throws ExceptionInterface
	 */
	public function configure (array $config): static
	{
		$banners = $config['banners'];
		unset($config['banners']);
		$this->denormalizer->denormalize($config, static::class, null, [
			AbstractNormalizer::OBJECT_TO_POPULATE => $this,
		]);
		$this->configureBanners($banners);

		return $this;
	}
}
