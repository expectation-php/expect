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



class DefaultMatcherFactory implements MatcherFactory
{

    private $container;


    public function __construct(MatcherContainer $container)
    {
        $this->container = $container;
    }

    public function create($name, array $arguments = [])
    {
        $matcherName = ucfirst($name);

        $matcherClass = $this->container->get($matcherName);
        $matcher = $matcherClass->newInstance($arguments);

        return $matcher;
    }

}
