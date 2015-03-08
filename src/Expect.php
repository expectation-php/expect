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


final class Expect
{

    private static $context;

    /**
     * @param string $configFile
     */
    public static function configure($configFile)
    {
        $config = Configuration::loadFromFile($configFile);
        $contextFactory = new DefaultContextFactory();
        static::$context = $contextFactory->createFromConfiguration($config);
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
