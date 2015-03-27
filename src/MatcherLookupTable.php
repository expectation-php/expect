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

/**
 * Implementation of container.
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 *
 * @see \expect\MatcherContainer
 */
trait MatcherLookupTable
{
    /**
     * Dictionary of matcher class.
     *
     * @var \Easy\Collections\Dictionary
     */
    private $matchers;

    /**
     * {@inheritdoc}
     */
    public function has($name)
    {
        return $this->matchers->containsKey($name);
    }

    /**
     * Find the matcher class by name.
     * Returns true if it is not found.
     *
     * @param string $name macther name
     *
     * @return bool
     */
    public function hasNot($name)
    {
        return $this->has($name) === false;
    }

    /**
     * {@inheritdoc}
     */
    public function get($name)
    {
        if ($this->hasNot($name)) {
            throw new MatcherNotRegistered("$name is not registered");
        }

        $matcherClass = $this->matchers->get($name);

        return $matcherClass;
    }
}
