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

final class MatcherDictionary implements MatcherContainer
{
    use MatcherLookupTable;

    public function __construct(array $matchers)
    {
        $this->matchers = Dictionary::fromArray($matchers);
    }

    public function count()
    {
        return count($this->matchers);
    }
}
