<?php

/**
 * This file is part of Bundle "IDM Advertising Bundle".
 *
 * @see https://github.com/idmarinas/advertising-bundle
 *
 * @license https://github.com/idmarinas/advertising-bundle/blob/master/LICENSE.txt
 * @author IDMarinas
 *
 * @since 0.1.0
 */

namespace Idm\Bundle\AdvertisingBundle\DependencyInjection\Network;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;

interface NetworkConfigurationInterface
{
    /**
     * Build configuration for provider.
     */
    public function buildConfiguration(NodeBuilder $node);
}
