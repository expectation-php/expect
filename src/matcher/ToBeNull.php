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

final class ToBeNull implements ReportableMatcher
{
    use EqualMatcherDelegatable;

    public function __construct()
    {
        $this->equalMatcher = new ToEqual(null);
    }
}
