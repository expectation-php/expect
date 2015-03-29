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
use expect\package\DefaultPackageRegistrar;
use expect\reporter\ExceptionReporter;

/**
 * Default configuration
 *
 * @package expect\config
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
class DefaultConfiguration implements Configuration
{
    use ConfigurableConfiguration;

    /**
     * Create a new default configuration
     */
    public function __construct()
    {
        $this->resultReporter = new ExceptionReporter();
        $this->matcherRegistrars[] = new DefaultPackageRegistrar();
    }
}
