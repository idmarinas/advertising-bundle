<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 20:56
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    AdsenseBanner.php
 * @date    09/03/2025
 * @time    22:49
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Provider\Banner;

use Idm\Bundle\Advertising\Enums\Provider\Network\AdsenseAdFormatEnum;
use Idm\Bundle\Advertising\Enums\Provider\Network\AdsenseAdTypeEnum;

final class AdsenseBanner extends AbstractBanner
{
	private string              $client;
	private AdsenseAdTypeEnum   $type;
	private AdsenseAdFormatEnum $format;
	private bool                $responsive;

	public function getClient (): string
	{
		return $this->client;
	}

	public function setClient (string $client): self
	{
		$this->client = $client;

		return $this;
	}

	public function getType (): AdsenseAdTypeEnum
	{
		return $this->type;
	}

	public function setType (AdsenseAdTypeEnum $type): self
	{
		$this->type = $type;

		return $this;
	}

	public function getFormat (): AdsenseAdFormatEnum
	{
		return $this->format;
	}

	public function setFormat (AdsenseAdFormatEnum $format): self
	{
		$this->format = $format;

		return $this;
	}

	public function isResponsive (): bool
	{
		return $this->responsive;
	}

	public function setResponsive (bool $responsive): self
	{
		$this->responsive = $responsive;

		return $this;
	}

	public function getTemplate (): string
	{
		$style = $this->getAttrStyle() . ($this->getType() == AdsenseAdTypeEnum::InArticle ? 'text-align:center;' : '');

		$attributes = ' data-ad-client="' . $this->getClient() . '"';
		$attributes .= ' data-ad-slot="' . $this->getSlot() . '"';
		$attributes .= $this->extraAttributesForBanner();
		$attributes .= ' class="' . $this->getAttrClass() . '"';
		$attributes .= ' style="' . $style . '"';
		$attributes .= $this->getNonce('style');

		foreach ($this->getAttributes() as $attr => $value) {
			$attributes .= ' ' . $attr . '="' . $value . '"';
		}

		$tpl = sprintf('<ins%s></ins>', $attributes);

		$script = sprintf(
			'<script%s>(adsbygoogle = window.adsbygoogle || []).push({});</script>',
			$this->getNonce('script')
		);

		return match ($this->type) {
			AdsenseAdTypeEnum::Search    => '<div class="gcse-search"></div>',
			AdsenseAdTypeEnum::Display,
			AdsenseAdTypeEnum::InArticle,
			AdsenseAdTypeEnum::InFeed,
			AdsenseAdTypeEnum::Multiplex => $tpl . $script,
		};
	}

	private function extraAttributesForBanner (): string
	{
		$format = match ($this->type) {
			AdsenseAdTypeEnum::InArticle,
			AdsenseAdTypeEnum::InFeed    => AdsenseAdFormatEnum::Fluid->value,
			AdsenseAdTypeEnum::Multiplex => 'autorelaxed',
			default                      => $this->format->value,
		};

		$attributes = match ($this->type) {
			AdsenseAdTypeEnum::InArticle => ' data-ad-layout="in-article"',
			AdsenseAdTypeEnum::Display   => ' data-full-width-responsive="' . var_export($this->isResponsive(), true) . '"',
			AdsenseAdTypeEnum::InFeed    => ' data-ad-layout-key="' . $this->getLayoutInFeed() . '"',
			default                      => ' '
		};
		$attributes .= ' data-ad-format="' . $format . '"';

		return $attributes;
	}
}
