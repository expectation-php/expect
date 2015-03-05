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


use expect\registry\MatcherNotRegistered;
use expect\registry\MatcherAlreadyRegistered;
use expect\package\MatcherClass;



final class DefaultMatcherRegistry implements MatcherRegistry
{

    private $matcherClasses;


    public function __construct()
    {
        $this->matcherClasses = [];
    }

    public function register(MatcherClass $matcherClass)
    {
        $name = $matcherClass->getClassName();

        if ($this->has($name)) {
            throw new MatcherAlreadyRegistered("$name is not registered");
        }

        $this->matcherClasses[$name] = $matcherClass;
    }

    public function has($name)
    {
        return array_key_exists($name, $this->matcherClasses);
    }

    public function hasNot($name)
    {
        return $this->has($name) === false;
    }

    public function get($name)
    {
        if ($this->hasNot($name)) {
            throw new MatcherNotRegistered("$name is not registered");
        }

        $matcherClass = $this->matcherClasses[$name];

        return $matcherClass;
    }

}
