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
use expect\context\DefaultContextFactory;
use expect\factory\DefaultMatcherFactory;
use expect\registry\DefaultMatcherRegistry;
use expect\reporter\ExceptionReporter;
use expect\package\DefaultPackageRegistrar;

/**
 * Default configurator
 *
 * Configure by the default
 *
 * @package expect\configurator
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class DefaultConfigurator implements Configurator
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $registry = new DefaultMatcherRegistry();

        $packageRegistrar = new DefaultPackageRegistrar();
        $packageRegistrar->registerTo($registry);

        $dictionary = $registry->toDictionary();
        $matcherFactory = new DefaultMatcherFactory($dictionary);

        return new DefaultContextFactory($matcherFactory, new ExceptionReporter());
    }
}
