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

/**
 * Immutable container of matcher.
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class MatcherDictionary implements MatcherContainer
{
    use MatcherLookupTable;

    /**
     * Create matcher dictionary.
     *
     * @param array matcher classes
     */
    public function __construct(array $matchers)
    {
        $this->matchers = Dictionary::fromArray($matchers);
    }

    /**
     * Count elements of an matcher class.
     *
     * @return int
     */
    public function count()
    {
        return count($this->matchers);
    }
}
