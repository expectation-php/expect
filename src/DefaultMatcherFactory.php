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


use Easy\Collections\Dictionary;


class DefaultMatcherFactory implements MatcherFactory
{

    private $matchers;


    public function __construct(array $matchers)
    {
        $this->matchers = Dictionary::fromArray($matchers);
    }

    public function create($name, array $arguments = [])
    {
        $matcher = null;
        $matcherClassName = $this->matchers->get($name);

        if (count($arguments) <= 0) {
            $matcher = new $matcherClassName();
        } else if (count($arguments) === 1) {
            $matcher = new $matcherClassName($arguments[0]);
        } else {
            $matcher = new $matcherClassName($arguments);
        }

        return $matcher;
    }

}
