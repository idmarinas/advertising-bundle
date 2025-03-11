<?php

/**
 * Copyright 2021-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 18:53
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    TwigScriptsEvent.php
 * @date    01/07/2021
 * @time    18:56
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   0.2.0
 */

namespace Idm\Bundle\Advertising\Event;

use Symfony\Contracts\EventDispatcher\Event;

final class TwigScriptsEvent extends Event
{
	/** Event that occurs after the scripts are getter. */
	public const TWIG_SHOW_SCRIPTS_POST = 'idm_advertising.twig.show_scripts.post';

	private array  $scripts = [];
	private string $nonce   = '';

	/** Get scripts. */
	public function getScripts (): array
	{
		return $this->scripts;
	}

	/** Set or reemplace scripts. */
	public function setScripts (array $scripts): self
	{
		$this->scripts = $scripts;

		return $this;
	}

	public function getNonce (): string
	{
		return $this->nonce;
	}

	public function setNonce (string $nonce): self
	{
		$this->nonce = $nonce;

		return $this;
	}

	public function getNonceAttribute (): string
	{
		if ('' == $this->nonce) {
			return '';
		}

		return ' nonce="' . $this->nonce . '"';
	}
}
