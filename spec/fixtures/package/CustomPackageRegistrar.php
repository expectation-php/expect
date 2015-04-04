<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace expect\fixture\package;

use expect\MatcherPackage;
use expect\MatcherRegistry;
use expect\PackageRegistrar;

class CustomPackageRegistrar implements PackageRegistrar
{
    /**
     * {@inheritdoc}
     */
    public function registerTo(MatcherRegistry $registry)
    {
        $matcherPackage = new MatcherPackage('\\expect\\fixture\\matcher', __DIR__ . '/../matcher');
        $matcherPackage->registerTo($registry);
    }
}
