<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 09/03/2025, 18:28
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    cpmstar.php
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
	$treeBuilder = new TreeBuilder('cpmstar');

	return $treeBuilder->getRootNode()
		->canBeEnabled()
			->info('Enable/disable CpmStar Network.')
		->fixXmlConfig('banner')
		->children()
			->scalarNode('service_network')
				->info('ID of custom service network.')
				->defaultValue('idm_advertising.network.cpmstar')
				->cannotBeEmpty()
			->end()
			->arrayNode('banners')
				->useAttributeAsKey('name')
				->requiresAtLeastOneElement()
				->arrayPrototype()
					->children()
						->integerNode('cpmstar_pid')
							->info('Pool ID of Ad block 8XXXXX1')
							->min(0)
							->isRequired()
						->end()
					->end()
				->end()
			->end()
		->end()
	;
	// @formatter:on
};
