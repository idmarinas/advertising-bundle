<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 08/03/2025, 10:50
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    definitions.php
 * @date    07/03/2025
 * @time    19:44
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;

return static function (DefinitionConfigurator $definition): void {
	$adsense = include __DIR__ . '/definitions/adsense.php';
	$cpmstar = include __DIR__ . '/definitions/cpmstar.php';
	$generic = include __DIR__ . '/definitions/generic.php';

	// @formatter:off
	$definition
		->rootNode()
			->canBeEnabled()
				->info('Enable/disable IDMarinas Advertising Bundle.')
			->fixXmlConfig('network')
			->children()
				->arrayNode('networks')
					->append($adsense())
					->append($cpmstar())
					->append($generic())
				->end()
			->end()
		->end()
	;
	// @formatter:on
};
