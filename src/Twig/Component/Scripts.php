<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 16:33
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    Scripts.php
 * @date    11/03/2025
 * @time    14:50
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

final class Scripts
{
	public ?string $network;

	#[PreMount]
	public function preMount (array $data): array
	{
		$resolver = new OptionsResolver();
		$resolver
			->setDefaults([
				'network' => null,
			])
			->setRequired('network')
			->setAllowedTypes('network', ['string', 'null'])
			->setAllowedValues('network', fn($value): bool => is_null($value) || in_array($value, NetworkEnum::values()))
		;

		return $resolver->resolve($data);
	}
}
