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
use expect\ResultReporter;

class RuntimeConfiguration implements Configuration
{
    use ConfigurableConfiguration;

    public function __construct(array $matcherPackages, ResultReporter $resultReporter)
    {
        $this->resultReporter = $resultReporter;
        $this->matcherPackages = $matcherPackages;
    }
}
