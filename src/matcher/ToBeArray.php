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
 * Verify whether the value is array type.
 *
 * <code>
 * $matcher = new ToBeArray();
 * $matcher->match([]); //return true
 *
 * $matcher->match(null); //return false
 * </code>
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeArray implements ReportableMatcher
{
    use TypeMatcherDelegatable;

    /**
     * Create a new matcher.
     */
    public function __construct()
    {
        $this->typeMatcher = new ToBeAn('array');
    }
}
