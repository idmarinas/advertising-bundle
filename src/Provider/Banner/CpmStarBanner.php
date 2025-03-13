<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 13/03/2025, 13:46
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    CpmStarBanner.php
 * @date    11/03/2025
 * @time    20:07
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Provider\Banner;

use Random\RandomException;

class CpmStarBanner extends AbstractBanner
{
	public function getUrl (): string
	{
		return '';
	}

	/**
	 * @throws RandomException
	 */
	public function getTemplate (): string
	{
		return sprintf(
			'<script%3$s%4$s src="https://server.cpmstar.com/view.aspx?poolid=%1$s&rnd=%2$s&script=1"></script>',
			$this->getSlot(),
			random_int(100000, 999999),
			$this->getNonce('script'),
			$this->processAttributes(
				array_filter(
					$this->getAttributes()->getArrayCopy(),
					fn($k) => $k != 'src',
					ARRAY_FILTER_USE_KEY
				)
			)
		);
	}
}
