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
 * Alias of ToBeGreaterThan.
 *
 * <code>
 * $matcher = new ToBeAbove(100);
 * $matcher->match(101); //return true
 *
 * $matcher->match(99); //return false
 * </code>
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeAbove implements ReportableMatcher
{
    use GreaterThanMatcherDelegatable;

    /**
     * @param int|float $expected
     */
    public function __construct($expected)
    {
        $this->greaterThanMatcher = new ToBeGreaterThan($expected);
    }
}
