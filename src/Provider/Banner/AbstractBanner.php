<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 18/09/2025, 17:04
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

	protected string    $attrClass    = '';
	protected string    $attrStyle    = '';
	private string      $name;
	private int         $slot;
	private string      $url;
	private ArrayObject $attributes;
	private string      $nonceScript  = '';
	private string      $nonceStyle   = '';
	private bool        $ignored      = false;
	private bool        $alternatived = false;
	private string      $altBanner    = '<span>Ad Dummy</span>';

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

	public function getAttrClass (): string
	{
		return $this->attrClass;
	}

	public function getAttrStyle (): string
	{
		return $this->attrStyle;
	}

	/**
	 * Check if the banner should be completely ignored and not displayed at all
	 */
	public function isIgnored (): bool
	{
		return $this->ignored;
	}

	public function setIgnored (bool $ignored): self
	{
		$this->ignored = $ignored;

		return $this;
	}

	/**
	 * Check if the alternative banner should be displayed instead of the real advertisement
	 */
	public function isAlternative (): bool
	{
		return $this->alternatived;
	}

	/**
	 * Enable or disable the alternative banner display
	 *
	 * @param bool $enabled True to show alternative banner, false to show real advertisement
	 */
	public function setAlternative (bool $enabled): self
	{
		$this->alternatived = $enabled;

		return $this;
	}

	public function getAlternativeBanner (): string
	{
		return $this->altBanner;
	}

	public function setAlternativeBanner (string $banner): self
	{
		$this->altBanner = $banner;

		return $this;
	}

	public function getTemplate (): string
	{
		return '<div%attributes%>%content%</div>';
	}
}
