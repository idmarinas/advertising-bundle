<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 12/03/2025, 14:15
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    AbstractBanner.php
 * @date    09/03/2025
 * @time    22:49
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Provider\Banner;

use ArrayObject;
use function Symfony\Component\String\u;

abstract class AbstractBanner
{
	private string      $name;
	private int         $slot;
	private string      $url;
	private ArrayObject $attributes;
	private string      $nonceScript   = '';
	private string      $nonceStyle    = '';
	private string      $layoutInFeed  = '';
	private string      $attrClass     = '';
	private string      $attrStyle     = '';
	private bool        $ignoredBanner = false;

	public function __construct ()
	{
		$this->setAttributes([]);
	}

	public function getName (): string
	{
		return $this->name;
	}

	public function setName (string $name): self
	{
		$this->name = $name;

		return $this;
	}

	public function getSlot (): int
	{
		return $this->slot;
	}

	public function setSlot (int $slot): self
	{
		$this->slot = $slot;

		return $this;
	}

	public function getUrl (): string
	{
		return $this->url;
	}

	public function setUrl (string $url): self
	{
		$this->url = $url;

		return $this;
	}

	public function getAttributes (): ArrayObject
	{
		return $this->attributes;
	}

	public function setAttributes (array $attributes): self
	{
		$this->attributes = new ArrayObject($attributes);

		if ($this->attributes->offsetExists('layout-in-feed')) {
			$this->layoutInFeed = $this->attributes->offsetGet('layout-in-feed');
			$this->attributes->offsetUnset('layout-in-feed');
		}

		$this->attrClass = 'adsbygoogle ';
		if ($this->attributes->offsetExists('class')) {
			$this->attrClass .= $this->attributes->offsetGet('class');
			$this->attrClass = implode(' ', array_unique(explode(' ', $this->attrClass)));
			$this->attributes->offsetUnset('class');
		}

		$this->attrStyle = 'display:block; ';
		if ($this->attributes->offsetExists('style')) {
			$this->attrStyle .= $this->attributes->offsetGet('style');
			$this->attrStyle = u($this->attrStyle)->replace('; ', ';')->ensureEnd(';')->toString();
			$this->attrStyle = implode(';', array_unique(explode(';', $this->attrStyle)));
			$this->attributes->offsetUnset('style');
		}

		return $this;
	}

	public function getNonceScript (): string
	{
		return $this->nonceScript;
	}

	public function setNonceScript (string $nonceScript): void
	{
		$this->nonceScript = $nonceScript;
	}

	public function getNonceStyle (): string
	{
		return $this->nonceStyle;
	}

	public function setNonceStyle (string $nonceStyle): void
	{
		$this->nonceStyle = $nonceStyle;
	}

	/**
	 * Get a formated nonce attribute for script or style
	 */
	public function getNonce (string $type): string
	{
		$nonce = match ($type) {
			'style'  => $this->getNonceStyle(),
			'script' => $this->getNonceScript(),
			default  => ''
		};

		if ('' === $nonce) {
			return '';
		}

		return ' nonce="' . $nonce . '"';
	}

	public function getLayoutInFeed (): string
	{
		return $this->layoutInFeed;
	}

	public function getAttrClass (): string
	{
		return $this->attrClass;
	}

	public function getAttrStyle (): string
	{
		return $this->attrStyle;
	}

	public function isIgnoredBanner (): bool
	{
		return $this->ignoredBanner;
	}

	public function setIgnoredBanner (bool $ignoredBanner): self
	{
		$this->ignoredBanner = $ignoredBanner;

		return $this;
	}

	public function getTemplate (): string
	{
		return '<div%attributes%>%content%</div>';
	}
}
