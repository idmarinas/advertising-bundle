<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 09/03/2025, 18:29
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    adsense.php
 * @date    07/03/2025
 * @time    19:44
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

use Idm\Bundle\Advertising\Enums\Provider\Network\AdsenseAdFormatEnum;
use Idm\Bundle\Advertising\Enums\Provider\Network\AdsenseAdTypeEnum;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

return static function (): NodeDefinition {
	// @formatter:off
	$treeBuilder = new TreeBuilder('adsense');

	return $treeBuilder->getRootNode()
		->canBeEnabled()
			->info('Enable/disable Adsense Network.')
		->fixXmlConfig('banner')
		->children()
			->scalarNode('service_network')
				->info('ID of custom service network.')
				->defaultValue('idm_advertising.network.adsense')
				->cannotBeEmpty()
			->end()
			->scalarNode('client')
				->info('Publisher identification like: ca-pub-XXXXXXX11XXX9')
				->isRequired()
				->cannotBeEmpty()
			->end()
			->arrayNode('banners')
				->requiresAtLeastOneElement()
				->useAttributeAsKey('name')
				->arrayPrototype()
					->children()
						->enumNode('type')
							->defaultValue(AdsenseAdTypeEnum::Display)
							->info('Select type of banner')
							->values(AdsenseAdTypeEnum::cases())
						->end()
						->integerNode('slot')
							->info('Slot ID of Ad block 8XXXXX1')
							->isRequired()
							->min(0)
						->end()
						->enumNode('format')
							->info('Format of Ad')
							->defaultValue(AdsenseAdFormatEnum::Auto)
							->values(AdsenseAdFormatEnum::cases())
						->end()
						->booleanNode('responsive')
							->info('Indicate if Ad is responsive, for mobile')
							->defaultTrue()
						->end()
					->end()
				->end()
			->end()
		->end()
	;
	// @formatter:on
};
