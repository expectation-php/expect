<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expect\configurator;

use expect\Configurator;
use expect\config\ConfigurationLoader;
use expect\registry\DefaultMatcherRegistry;
use expect\factory\DefaultMatcherFactory;
use expect\context\DefaultContextFactory;



class FileConfigurator implements Configurator
{

    private $config;


    public function __construct($configFile)
    {
        $loader = new ConfigurationLoader();
        $this->config = $loader->loadFromFile($configFile);
    }

    public function configure()
    {
        $registry = new DefaultMatcherRegistry();
        $packages = $this->config->getMatcherPackages();

        foreach ($packages as $package) {
            $package->registerTo($registry);
        }

        $dictionary = $registry->toDictionary();
        $matcherFactory = new DefaultMatcherFactory($dictionary);

        $resultReporter = $this->config->getResultReporter();

        return new DefaultContextFactory($matcherFactory, $resultReporter);
    }

}
