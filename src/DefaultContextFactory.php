<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expect;


class DefaultContextFactory implements ContextFactory
{

    public function createFromConfiguration(Configuration $config)
    {
        $registry = new DefaultMatcherRegistry();
        $packages = $config->getMatcherPackages();

        foreach ($packages as $package) {
            $package->registerTo($registry);
        }

        $dictionary = $registry->toDictionary();
        $matcherFactory = new DefaultMatcherFactory($dictionary);

        $resultReporter = $config->getResultReporter();

        return new EvaluateContext($matcherFactory, $resultReporter);
    }

}
