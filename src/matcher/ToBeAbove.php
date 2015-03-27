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

final class ToBeAbove implements ReportableMatcher
{
    use GreaterThanMatcherDelegatable;

    public function __construct($expected)
    {
        $this->greaterThanMatcher = new ToBeGreaterThan($expected);
    }
}
