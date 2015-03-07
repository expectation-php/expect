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

use expect\config\ConfigurationFileNotFoundException;
use Yosymfony\Toml\Toml;
use Easy\Collections\Dictionary;


class Configuration
{

    private $resultReporter;
    private $matcherPackages;


    public function __construct(array $values)
    {
        $config = Dictionary::fromArray($values);

        if ($config->containsKey('packages')) {
            $packages = $config->get('packages');
            $this->loadPackages($packages);
        }

        if ($config->containsKey('reporter')) {
            $reporter = $config->get('reporter');
            $this->loadReporter($reporter);
        }
    }

    private function loadPackages(array $packages)
    {
        $matcherPackages = [];

        foreach ($packages as $package) {
            $matcherPackages[] = new $package();
        }
        $this->matcherPackages = $matcherPackages;
    }

    private function loadReporter($reporter)
    {

        $this->resultReporter = new $reporter();
    }

    public function getMatcherPackages()
    {
        return $this->matcherPackages;
    }

    public function getResultReporter()
    {
        return $this->resultReporter;
    }

    public static function loadFromFile($file)
    {
        if (file_exists($file) === false) {
            throw new ConfigurationFileNotFoundException("$file not found");
        }
        $values = Toml::parse($file);

        return new Configuration($values);
    }

}
