<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 13/03/2025, 15:50
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
use Idm\Bundle\Advertising\Provider\Banner\Traits\ProcessTrait;

abstract class AbstractBanner
{
	use ProcessTrait;

	protected string    $attrClass     = '';
	protected string    $attrStyle     = '';
	private string      $name;
	private int         $slot;
	private string      $url;
	private ArrayObject $attributes;
	private string      $nonceScript   = '';
	private string      $nonceStyle    = '';
	private string      $layoutInFeed  = '';
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

		if ($this->attributes->offsetExists('class')) {
			$this->attrClass .= ' ' . $this->attributes->offsetGet('class');
			$this->attrClass = $this->processClasses($this->attrClass);
			$this->attributes->offsetUnset('class');
		}

		if ($this->attributes->offsetExists('style')) {
			$this->attrStyle .= $this->attributes->offsetGet('style');
			$this->attrStyle = $this->processStyles($this->attrStyle);
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
