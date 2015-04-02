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

/**
 * Configurable
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
interface Configurable
{
    /**
     * Configure by configurator
     *
     * If the configurator is null, initialized with minimum configuration.
     *
     * @param Configurator $configurator
     */
    public static function configure(Configurator $configurator = null);
}
