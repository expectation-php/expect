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

use expect\MatcherPackage;
use expect\MatcherRegistry;
use expect\RegisterablePackage;

class DefaultMatcherPackage implements RegisterablePackage
{
    /**
     * {@inheritdoc}
     */
    public function registerTo(MatcherRegistry $registry)
    {
        $matcherPackage = new MatcherPackage(
            '\\expect\\matcher',
            __DIR__.'/../matcher'
        );
        $matcherPackage->registerTo($registry);
    }
}
