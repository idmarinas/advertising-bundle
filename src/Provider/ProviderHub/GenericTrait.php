<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 08/03/2025, 13:08
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    GenericTrait.php
 * @date    08/03/2025
 * @time    12:56
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Provider\ProviderHub;

use Idm\Bundle\Advertising\Provider\Network\GenericNetwork;

trait GenericTrait
{
    private GenericNetwork $genericNetwork;

    public function getGenericNetwork (): GenericNetwork
    {
        return $this->genericNetwork;
    }

    public function setGenericNetwork (GenericNetwork $network): self
    {
        $this->genericNetwork = $network;

        return $this;
    }
}
