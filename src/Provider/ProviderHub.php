<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 13:39
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    ProviderHub.php
 * @date    08/03/2025
 * @time    11:26
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Provider;

use Idm\Bundle\Advertising\Enums\Provider\NetworkEnum;
use Idm\Bundle\Advertising\Provider\Network\NetworkInterface;
use Idm\Bundle\Advertising\Provider\ProviderHub\AdsenseTrait;
use Idm\Bundle\Advertising\Provider\ProviderHub\CpmStarTrait;
use Idm\Bundle\Advertising\Provider\ProviderHub\GenericTrait;
use InvalidArgumentException;

final class ProviderHub
{
	use AdsenseTrait;
	use CpmStarTrait;
	use GenericTrait;

	private bool  $advertisingEnabled;
	private array $scriptsUrls = [];

	/**
	 * Get network service by name
	 */
	public function getNetwork (string|NetworkEnum $network): ?NetworkInterface
	{
		if (!$this->isAdvertisingEnabled()) {
			return null;
		}

		$service = match ($network) {
			NetworkEnum::Adsense,
			NetworkEnum::Adsense->value => $this->getAdsenseNetwork(),
			NetworkEnum::CpmStar,
			NetworkEnum::CpmStar->value => $this->getCpmstarNetwork(),
			default                     => $this->getGenericNetwork(),
		};

		return $service->isNetworkEnabled() ? $service : null;
	}

	public function getScriptsUrls (?string $network = null): array
	{
		// Return all scripts
		if (null === $network) {
			return array_unique(array_merge(...array_values($this->scriptsUrls)));
		}

		// Return empty array is scriptsUrls is empty or network not found or is empty
		if ([] === $this->scriptsUrls || empty($this->scriptsUrls[$network])) {
			return [];
		}

		return array_unique($this->scriptsUrls[$network]);
	}

	public function setScriptUrls (string $network, string|array $scriptsUrls): self
	{
		$scriptsUrls = is_string($scriptsUrls) ? [$scriptsUrls] : $scriptsUrls;

		$this->scriptsUrls[$network] = $this->scriptsUrls[$network] ?? [];

		array_push($this->scriptsUrls[$network], ...$scriptsUrls);

		return $this;
	}

	public function setNetwork (string|NetworkEnum $name, NetworkInterface $network): self
	{
		$fn = NetworkEnum::getSetNetworkName($name);

		if (null === $fn) {
			throw new InvalidArgumentException(sprintf('The network "%s" does not exist.', $name));
		}

		$this->{$fn}($network);

		return $this;
	}

	public function isAdvertisingEnabled (): bool
	{
		return $this->advertisingEnabled;
	}

	public function enableAdvertising (): self
	{
		$this->advertisingEnabled = true;

		return $this;
	}

	public function disableAdvertising (): self
	{
		$this->advertisingEnabled = false;

		return $this;
	}
}
