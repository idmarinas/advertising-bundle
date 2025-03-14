<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 17:06
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    GenericNetwork.php
 * @date    14/03/2025
 * @time    16:46
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace App\Provider\Network;

use App\Provider\Banner\GenericBanner;
use ArrayObject;
use Idm\Bundle\Advertising\Provider\Network\AbstractNetwork;
use Idm\Bundle\Advertising\Provider\Network\NetworkInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class GenericNetwork extends AbstractNetwork
{
	public function getScriptUrl (string $type): string
	{
		return 'https://generic.network';
	}

	/**
	 * @inheritDoc
	 * @throws ExceptionInterface
	 */
	public function configureBanners (array $banners): NetworkInterface
	{
		$this->banners = new ArrayObject();

		foreach ($banners as $banner => $config) {
			$config['name'] = $banner;
			$obj = $this->denormalizer->denormalize($config, GenericBanner::class, 'array');
			$this->banners->offsetSet($banner, $obj);
		}

		return $this;
	}
}
