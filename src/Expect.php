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

use expect\configurator\DefaultConfigurator;

/**
 * Expect
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class Expect implements Configurable
{
    /**
     * @var \expect\ContextFactory
     */
    private static $contextFactory;

    /**
     * {@inheritdoc}
     */
    public static function configure(Configurator $configurator = null)
    {
        $useConfigurator = $configurator;

        if ($useConfigurator === null) {
            $useConfigurator = new DefaultConfigurator();
        }
        self::$contextFactory = $useConfigurator->configure();
    }

    /**
     * @param mixed $actual
     *
     * @return Context
     */
    public static function that($actual)
    {
        $context = self::$contextFactory->newContext();

        return $context->actual($actual);
    }
}
