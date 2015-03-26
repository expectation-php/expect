<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace expect\config;

use Yosymfony\Toml\Toml;
use Easy\Collections\Dictionary;

class ConfigurationLoader
{
    public function loadFromFile($file)
    {
        if (file_exists($file) === false) {
            throw new ConfigurationFileNotFoundException("$file not found");
        }
        $values = Toml::parse($file);

        $defaultConfig = new DefaultConfiguration();
        $runtimeConfig = $this->loadFromArray($values);

        return $defaultConfig->merge($runtimeConfig);
    }

    public function loadFromArray(array $values)
    {
        $config = Dictionary::fromArray($values);
        $loadedPackages = [];
        $loadedReporter = null;

        if ($config->containsKey('packages')) {
            $packages = $config->get('packages');
            $loadedpPackages = $this->loadPackages($packages->toArray());
        }

        if ($config->containsKey('reporter')) {
            $reporter = $config->get('reporter');
            $loadedReporter = $this->loadReporter($reporter);
        }

        return new RuntimeConfiguration($loadedPackages, $loadedReporter);
    }

    //FIXME Too miscellaneous
    private function loadPackages(array $packages)
    {
        $matcherPackages = [];

        foreach ($packages as $package) {
            $matcherPackages[] = new $package();
        }

        return $matcherPackages;
    }

    //FIXME Too miscellaneous
    private function loadReporter($reporter)
    {
        return new $reporter();
    }
}
