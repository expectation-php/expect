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
 * Verify value is false
 *
 * <code>
 * $matcher = new ToBeFalse();
 * $matcher->match(false); //return true
 *
 * $matcher->match(true); //return false
 * $matcher->match("foo"); //return false
 * </code>
 *
 * @package expect\matcher
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeFalse implements ReportableMatcher
{
    use EqualMatcherDelegatable;

    /**
     * Create a new matcher
     */
    public function __construct()
    {
        $this->equalMatcher = new ToEqual(false);
    }
}
