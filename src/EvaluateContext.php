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


use expect\DefaultMatcherFactory;
use expect\DefaultMatcherRegistry;



class EvaluateContext implements Context
{

    private $config;


    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    public function getMatcherFactory()
    {
        $registry = new DefaultMatcherRegistry();
        $packages = $this->config->getMatcherPackages();

        foreach ($packages as $package) {
            $package->registerTo($registry);
        }

        $factory = new DefaultMatcherFactory($registry);

        return $factory;
    }

    public function getResultReporter()
    {
        return $this->config->getResultReporter();
    }

    public static function fromConfiguration(Configuration $config)
    {
        return new self($config);
    }

}
