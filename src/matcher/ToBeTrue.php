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
 * Verify value is true.
 *
 * <code>
 * $matcher = new ToBeTrue();
 * $matcher->match(true); //return true
 *
 * $matcher->match(false); //return false
 * $matcher->match("foo"); //return false
 * </code>
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeTrue implements ReportableMatcher
{
    use EqualMatcherDelegatable;

    /**
     * Create a new matcher.
     */
    public function __construct()
    {
        $this->equalMatcher = new ToEqual(true);
    }
}
