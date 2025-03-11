<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 10/03/2025, 21:49
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    NetworkEnum.php
 * @date    09/03/2025
 * @time    18:33
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Enums\Provider;

use Idm\Bundle\Advertising\Enums\Traits\EnumToArrayTrait;

enum NetworkEnum: string
{
	use EnumToArrayTrait;

	case Adsense = 'adsense';
	case CpmStar = 'cpmstar';
	case Generic = 'generic';

	public static function getSetNetworkName (string|NetworkEnum $network): ?string
	{
		return match ($network) {
			self::Adsense,
			self::Adsense->value => 'setAdsenseNetwork',
			self::CpmStar,
			self::CpmStar->value => 'setCpmstarNetwork',
			self::Generic,
			self::Generic->value => 'setGenericNetwork',
			default              => null,
		};
	}
}
