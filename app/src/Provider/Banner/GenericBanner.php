<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 17:21
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    GenericBanner.php
 * @date    14/03/2025
 * @time    17:05
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace App\Provider\Banner;

use Idm\Bundle\Advertising\Provider\Banner\AbstractBanner;

class GenericBanner extends AbstractBanner
{
	public function getTemplate (): string
	{
		$tpl = parent::getTemplate();

		return str_replace(['%attributes%' => ' data-enum="enum"'], ['%content%' => '<span>Ad Generic</span>'], $tpl);
	}
}
