<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 16:11
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    Banner.php
 * @date    07/03/2025
 * @time    18:23
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Twig\Component;

use Idm\Bundle\Advertising\Enums\Provider\NetworkEnum;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\PreMount;

final class Banner
{
	public string $network;
	public string $banner;

	#[PreMount]
	public function preMount (array $data): array
	{
		$resolver = new OptionsResolver();
		$resolver
			->setDefaults([
				'network' => '',
				'banner'  => '',
			])
			->setRequired('network')
			->setAllowedTypes('network', 'string')
			->setAllowedValues('network', fn($value): bool => in_array($value, NetworkEnum::values()))
			->setRequired('banner')
			->setAllowedTypes('banner', 'string')
		;

		return $resolver->resolve($data);
	}
}
