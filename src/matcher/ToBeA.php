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
 * Alias of ToBeAn class
 *
 * <code>
 * $matcher = new ToBeA('string');
 * $matcher->match('foo'); //return true
 *
 * $matcher->match(1); //return false
 * </code>
 *
 * @package expect\matcher
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeA implements ReportableMatcher
{
    use TypeMatcherDelegatable;

    /**
     * Create a new matcher
     *
     * @param string $expected
     */
    public function __construct($expected)
    {
        $this->typeMatcher = new ToBeAn($expected);
    }
}
