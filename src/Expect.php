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

    private static $context;

    public static function configure(Configurator $configurator)
    {
        static::$context = $configurator->configure();
    }

    /**
     * @param mixed $actual
     * @return MatcherEvaluator
     */
    public static function that($actual)
    {
        $evaluator = MatcherEvaluator::fromContext(static::$context);
        return $evaluator->actual($actual);
    }

}
