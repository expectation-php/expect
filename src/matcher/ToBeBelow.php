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
 * Alias of ToBeLessThan.
 *
 * <code>
 * $matcher = new ToBeBelow(100);
 * $matcher->match(99); //return true
 *
 * $matcher->match(100); //return false
 * </code>
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeBelow implements ReportableMatcher
{
    use LessThanMatcherDelegatable;

    /**
     * @param int|float $expected
     */
    public function __construct($expected)
    {
        $this->lessThanMatcher = new ToBeLessThan($expected);
    }
}
