<?php
/**
 * Copyright 2025-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 10/03/2026, 22:07
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

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Idm\Bundle\Advertising\Enums\Provider\Network\AdsenseAdTypeEnum;

return function (ContainerConfigurator $container) {

	$container->extension('idm_advertising', [
		'adsense' => [
			'enabled' => true,
			'client'  => 'ca-pub-XXXXXXX11XXX9',
			'banners' => [
				'ad_header' => [
					'slot'       => 4555454,
					'responsive' => true,
					'attributes' => [
						'class' => 'ads',
						'style' => 'display: inline-block;',
					],
				],
				'main'      => [
					'slot'       => 54555454,
					'responsive' => false,
					'attributes' => [
						'class' => 'adsbygoogle',
						'style' => 'display:block',
					],
				],
				'article'   => [
					'slot' => 45345454,
					'type' => AdsenseAdTypeEnum::InArticle->value,
				],
				'feed'      => [
					'slot'       => 4559454,
					'type'       => AdsenseAdTypeEnum::InFeed->value,
					'attributes' => [
						'layout-in-feed' => '-6t+ed+2i-1n-4w',
					],
				],
			],
		],
		'cpmstar' => [
			'enabled' => true,
			'banners' => [
				'main' => [
					'slot' => 4555454,
				],
				'head' => [
					'slot'       => 4559454,
					'attributes' => [
						'class'      => 'cpmstart',
						'style'      => 'display: inline-block;',
						'src'        => 'http://example.script',
						'data-other' => 'other-attribute',
					],
				],
			],
		],
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
