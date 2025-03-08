<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 08/03/2025, 10:46
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    generic.php
 * @date    07/03/2025
 * @time    19:44
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

return static function (): NodeDefinition {
	// @formatter:off
	$treeBuilder = new TreeBuilder('generic');

	return $treeBuilder->getRootNode()
		->canBeEnabled()
			->info('Enable/disable Generic Network.')
		->fixXmlConfig('banner')
		->children()
			->scalarNode('service_network')
				->info('ID of custom service network.')
				->isRequired()
				->cannotBeEmpty()
			->end()
			->arrayNode('banners')
				->useAttributeAsKey('name')
				->arrayPrototype()
					->scalarPrototype()->end()
				->end()
			->end()
		->end()
	;
	// @formatter:on
};
