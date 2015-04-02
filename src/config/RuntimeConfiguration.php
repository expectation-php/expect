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

/**
 * Runtime configuration
 *
 * @package expect\config
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
class RuntimeConfiguration implements Configuration
{
    use ConfigurableConfiguration;

    /**
     * @param \expect\PackageRegistrar[] $matcherRegistrars package registrars
     * @param ResultReporter $resultReporter reporter of result
     */
    public function __construct(array $matcherRegistrars = [], ResultReporter $resultReporter = null)
    {
        $this->resultReporter = $resultReporter;
        $this->matcherRegistrars = $matcherRegistrars;
    }
}
