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

final class Expect implements Configurable
{
    private static $contextFactory;

    public static function configure(Configurator $configurator)
    {
        static::$contextFactory = $configurator->configure();
    }

    /**
     * @param mixed $actual
     *
     * @return Context
     */
    public static function that($actual)
    {
        $context = static::$contextFactory->newContext();

        return $context->actual($actual);
    }
}
