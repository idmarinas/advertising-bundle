<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 14:13
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    EnumToArrayTraitTest.php
 * @date    14/03/2025
 * @time    14:03
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Tests\Enums\Traits;

use App\Enums\TestEnum;
use PHPUnit\Framework\TestCase;

class EnumToArrayTraitTest extends TestCase
{
	public function testEnumTrait ()
	{
		$values = TestEnum::values();
		$names = TestEnum::names();
		$array = TestEnum::asArray();

		$this->assertEquals(['uno', 'dos', 'tres', 'cuatro'], $values);
		$this->assertEquals(['UNO', 'DOS', 'TRES', 'CUATRO'], $names);
		$this->assertEquals(['UNO' => 'uno', 'DOS' => 'dos', 'TRES' => 'tres', 'CUATRO' => 'cuatro'], $array);
	}
}
