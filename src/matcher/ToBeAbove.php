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


use expect\Matcher;
use expect\FailedMessage;
use expect\matcher\alias\GreaterThanMatcherAlias;


final class ToBeAbove implements Matcher
{

    use GreaterThanMatcherDelegatable;


    public function __construct($expected)
    {
        $this->greaterThanMatcher = new ToBeGreaterThan($expected);
    }

}
