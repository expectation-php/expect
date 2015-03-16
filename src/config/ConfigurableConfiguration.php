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


use expect\Configuration;


trait ConfigurableConfiguration
{

    private $resultReporter = null;
    private $matcherPackages = [];


    public function getMatcherPackages()
    {
        return $this->matcherPackages;
    }

    public function getResultReporter()
    {
        return $this->resultReporter;
    }

    public function merge(Configuration $config)
    {
        $matcherPackages = array_merge(
            $this->matcherPackages,
            $config->getMatcherPackages()
        );

        $reporter = $config->getResultReporter();

        if ($reporter === null) {
            $reporter = $this->resultReporter;
        }

        return new RuntimeConfiguration($matcherPackages, $reporter);
    }

}
