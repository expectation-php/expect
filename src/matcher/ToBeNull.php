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
 * Verify whether the value is null.
 *
 * <code>
 * $matcher = new ToBeNull();
 * $matcher->match(null); //return true
 *
 * $matcher->match(0); //return false
 * </code>
 *
 * @package expect\matcher
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeNull implements ReportableMatcher
{
    use EqualMatcherDelegatable;

    /**
     * Create a new matcher
     */
    public function __construct()
    {
        $this->equalMatcher = new ToEqual(null);
    }
}
