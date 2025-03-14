<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 14:13
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    TestEnum.php
 * @date    14/03/2025
 * @time    14:06
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace App\Enums;

use Idm\Bundle\Advertising\Enums\Traits\EnumToArrayTrait;

enum TestEnum: string
{
	use EnumToArrayTrait;

	case UNO    = 'uno';
	case DOS    = 'dos';
	case TRES   = 'tres';
	case CUATRO = 'cuatro';
}
