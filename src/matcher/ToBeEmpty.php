<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expect\matcher;

/**
 * Verify the length of the value is 0.
 *
 * <code>
 * $matcher = new ToBeEmpty();
 * $matcher->match(""); //return true
 *
 * $matcher->match("fo"); //return false
 * $matcher->match([ 1, 2 ]); //return false
 * $matcher->match(new ArrayIterator([ 1, 2 ])); //return false
 * <code>
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeEmpty implements ReportableMatcher
{
    use LengthMatcherDelegatable;

    /**
     * Create a new matcher
     */
    public function __construct()
    {
        $this->lengthMatcher = new ToHaveLength(0);
    }
}
