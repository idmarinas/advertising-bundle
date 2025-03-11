<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 10/03/2025, 21:49
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    AdsenseAdFormatEnum.php
 * @date    09/03/2025
 * @time    18:25
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Enums\Provider\Network;

use Idm\Bundle\Advertising\Enums\Traits\EnumToArrayTrait;

enum AdsenseAdFormatEnum: string
{
	use EnumToArrayTrait;

	case Auto       = 'auto';
	case Rectangle  = 'rectangle';
	case Vertical   = 'vertical';
	case Horizontal = 'horizontal';
	case Fluid      = 'fluid';
}
