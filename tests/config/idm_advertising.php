<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 14:27
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    idm_advertising.php
 * @date    12/03/2025
 * @time    16:26
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

use Idm\Bundle\Advertising\Enums\Provider\Network\AdsenseAdTypeEnum;
use Symfony\Config\IdmAdvertisingConfig;

return function (IdmAdvertisingConfig $config) {
	// @formatter:off
	$adsense = $config->adsense()->enabled(true)->client('ca-pub-XXXXXXX11XXX9');
	$adsense
			->banner('ad_header')
				->slot(4555454)
				->responsive(true)
				->attributes([
					'class' => 'ads',
					'style' => 'display: inline-block;'
				])
	;
	$adsense->banner('main')
		->slot(54555454)
		->responsive(false)
		->attributes([
			'class' => 'adsbygoogle',
			'style' => 'display:block',
		])
	;
	$adsense->banner('article')
		->slot(45345454)
		->type(AdsenseAdTypeEnum::InArticle->value)
	;
	$adsense->banner('feed')
		->slot(4559454)
		->type(AdsenseAdTypeEnum::InFeed->value)
		->attributes([
			'layout-in-feed' => '-6t+ed+2i-1n-4w'
		])
	;

	$cpmstar = $config->cpmstar()->enabled(true);

	$cpmstar->banner('main')->slot(4555454);
	$cpmstar->banner('head')->slot(4559454)->attributes([
		'class' => 'cpmstart',
		'style' => 'display: inline-block;',
		'src' => 'http://example.script',
		'data-other' => 'other-attribute'
	]);
};

/*
idm_advertising:
  adsense:
    enabled: true
    service_network: idm_advertising.network.adsense
    client: ca-pub-XXXXXXX11XXX9
    banners:
      name:
        type: display
        slot: 4555454
        format: auto
        responsive: true

  # generic:
  #   enabled: false
  #   service_network: null # Required
  #   banners:
  #     name:
  #       slot: ~
  #       attributes: ~
*/
