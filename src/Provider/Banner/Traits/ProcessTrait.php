<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 13/03/2025, 15:50
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    ProcessTrait.php
 * @date    13/03/2025
 * @time    15:48
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Provider\Banner\Traits;

use Symfony\Component\String\UnicodeString;
use function Symfony\Component\String\u;

trait ProcessTrait
{
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

	public function processAttributes (array $attributes, bool $style = false): string
	{
		$attrs = '';

		$tpl = $style ? '%1$s:%2$s;' : ' %1$s="%2$s"';
		foreach ($attributes as $attr => $value) {
			$attrs .= sprintf($tpl, $attr, $value);
		}

		return $attrs;
	}

	private function processClasses (string $class): string
	{
		$class = u($class)->trim()->split(' ');
		$class = array_map(fn($v) => $v->trim()->toString(), $class);
		$class = array_filter(array_unique($class));

		return implode(' ', $class);
	}

	private function processStyles (string $style): string
	{
		$style = u($style)->trim()->replaceMatches('/( *;+ *)/', ';')->replaceMatches('/( *:+ *)/', ':')->split(';');
		$style = array_map(fn($v) => $v->trim()->split(':'), $style);

		array_walk($style, function (&$value) {
			$v = $value;
			$value = null;

			if (count($v) > 1) {
				/** @var UnicodeString[] $v */
				$value[$v[0]->trim()->toString()] = $v[1]->trim()->toString();
			}
		});

		return $this->processAttributes(array_merge(...array_filter($style)), true);
	}
}
