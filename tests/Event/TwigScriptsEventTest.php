<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 13:58
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    TwigScriptsEventTest.php
 * @date    14/03/2025
 * @time    13:55
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Tests\Event;

use Idm\Bundle\Advertising\Event\TwigScriptsEvent;
use PHPUnit\Framework\TestCase;

class TwigScriptsEventTest extends TestCase
{
	public function testEvent ()
	{
		$nonce = uniqid();
		$event = new TwigScriptsEvent();
		$event->setNonce($nonce);

		$attr = ' nonce="' . $nonce . '"';

		$this->assertEquals($nonce, $event->getNonce());
		$this->assertEquals($attr, $event->getNonceAttribute());
	}
}
