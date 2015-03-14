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


use expect\reporter\TextMessageReporter;
use expect\package\DefaultMatcherPackage;


class DefaultConfiguration
{

    private $resultReporter;
    private $matcherPackages = [];


    public function __construct()
    {
        $this->resultReporter = new TextMessageReporter;
        $this->matcherPackages[] = new DefaultMatcherPackage;
    }

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







    }

}
