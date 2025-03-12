<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 12/03/2025, 14:01
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    EnumToArrayTrait.php
 * @date    10/03/2025
 * @time    21:47
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Enums\Traits;

/**
 * @method static cases()
 */
trait EnumToArrayTrait
{
	public static function names (): array
	{
		return array_column(self::cases(), 'name');
	}

	public static function values (): array
	{
		return array_column(self::cases(), 'value');
	}

	/**
	 * Return an associative array
	 */
	public static function asArray (): array
	{
		return array_column(self::cases(), 'value', 'name');
	}
}
