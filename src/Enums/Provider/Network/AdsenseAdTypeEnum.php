<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 10/03/2025, 21:49
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    AdsenseAdTypeEnum.php
 * @date    09/03/2025
 * @time    18:10
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Enums\Provider\Network;

use Idm\Bundle\Advertising\Enums\Traits\EnumToArrayTrait;

enum AdsenseAdTypeEnum: string
{
	use EnumToArrayTrait;

	case InArticle = 'in-article';
	case Display   = 'display';
	case Search    = 'search';
	case InFeed    = 'in-feed';
	case Multiplex = 'multiplex';
}
