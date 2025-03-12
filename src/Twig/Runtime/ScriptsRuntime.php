<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 12/03/2025, 15:55
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    ScriptsRuntime.php
 * @date    07/03/2025
 * @time    17:32
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Twig\Runtime;

use Idm\Bundle\Advertising\Event\TwigScriptsEvent;
use Idm\Bundle\Advertising\Provider\ProviderHub;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Twig\Extension\RuntimeExtensionInterface;
use function sprintf;

final readonly class ScriptsRuntime implements RuntimeExtensionInterface
{
	public function __construct (private EventDispatcherInterface $eventDispatcher, private ProviderHub $providerHub) {}

	public function showScripts (?string $networkName = null): string
	{
		if (!$this->providerHub->isAdvertisingEnabled()) {
			return '';
		}

		$scripts = $this->providerHub->getScriptsUrls($networkName);

		$event = new TwigScriptsEvent();
		$event->setScripts($scripts);
		$this->eventDispatcher->dispatch($event, TwigScriptsEvent::TWIG_SHOW_SCRIPTS_POST);

		$scripts = array_filter($event->getScripts());

		if ([] == $scripts) {
			return '';
		}

		return sprintf(
			'<script%1$s async crossorigin="anonymous" src="'
			. implode('"></script><script%1$s async crossorigin="anonymous" src="', $scripts) .
			'"></script>',
			$event->getNonceAttribute()
		);
	}

	public function render (array $args = []): string
	{
		$network = $args['network'] ?? null;

		return $this->showScripts($network);
	}
}
