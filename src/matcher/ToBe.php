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
 * Alias of ToEuqal
 *
 * <code>
 * $matcher = new ToBe(100);
 * $matcher->match(100); //return true
 *
 * $matcher = new ToBe(100);
 * $matcher->match(99); //return false
 * <code>
 *
 * @package expect\matcher
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 * @see expect\matcher\ToEqual
 */
final class ToBe implements ReportableMatcher
{
    use EqualMatcherDelegatable;

    /**
     * Create a new matcher
     *
     * @param mixed $expected expected value
     */
    public function __construct($expected)
    {
        $this->equalMatcher = new ToEqual($expected);
    }
}
