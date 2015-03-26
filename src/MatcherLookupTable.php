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

trait MatcherLookupTable
{
    /**
     * @var \Easy\Collections\Dictionary
     */
    private $matchers;

    public function has($name)
    {
        return $this->matchers->containsKey($name);
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

        $matcherClass = $this->matchers->get($name);

        return $matcherClass;
    }
}
