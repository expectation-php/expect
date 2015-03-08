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


class DefaultContextLoader implements ContextLoader
{

    private $config;


    public function __construct($configFile)
    {
        $this->config = Configuration::loadFromFile($configFile);
    }

    public function load()
    {
        $registry = new DefaultMatcherRegistry();
        $packages = $this->config->getMatcherPackages();

        foreach ($packages as $package) {
            $package->registerTo($registry);
        }

        $dictionary = $registry->toDictionary();
        $matcherFactory = new DefaultMatcherFactory($dictionary);

        $resultReporter = $this->config->getResultReporter();

        return new EvaluateContext($matcherFactory, $resultReporter);
    }

}
