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
 * Verify whether the value is integer type.
 *
 * <code>
 * $matcher = new ToBeInteger();
 * $matcher->match(1); //return true
 *
 * $matcher->match(1.1); //return false
 * </code>
 *
 * @package expect\matcher
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeInteger implements ReportableMatcher
{
    use TypeMatcherDelegatable;

    /**
     * Create a new matcher
     */
    public function __construct()
    {
        $this->typeMatcher = new ToBeAn('integer');
    }
}
