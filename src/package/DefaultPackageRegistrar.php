<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace expect\package;

use expect\MatcherRegistry;
use expect\PackageRegistrar;

/**
 * Default package registrar
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class DefaultPackageRegistrar implements PackageRegistrar
{
    /**
     * {@inheritdoc}
     */
    public function registerTo(MatcherRegistry $registry)
    {
        $package = new DefaultMatcherPackage();
        $package->registerTo($registry);
    }
}
