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

use expect\config\ConfigurationLoader;
use expect\Configurator;
use expect\context\DefaultContextFactory;
use expect\factory\DefaultMatcherFactory;
use expect\registry\DefaultMatcherRegistry;

/**
 * File configurator
 *
 * Configure by the toml file
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
class FileConfigurator implements Configurator
{
    /**
     * @var \expect\Configuration
     */
    private $config;

    /**
     * @param string $configFile
     *
     * @throws \expect\config\ConfigurationFileNotFoundException
     */
    public function __construct($configFile)
    {
        $loader = new ConfigurationLoader();
        $this->config = $loader->loadFromFile($configFile);
    }

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $registry = new DefaultMatcherRegistry();
        $packages = $this->config->getMatcherRegistrars();

        foreach ($packages as $package) {
            $package->registerTo($registry);
        }

        $dictionary = $registry->toDictionary();
        $matcherFactory = new DefaultMatcherFactory($dictionary);

        $resultReporter = $this->config->getResultReporter();

        return new DefaultContextFactory($matcherFactory, $resultReporter);
    }
}
