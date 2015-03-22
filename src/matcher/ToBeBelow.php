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
use expect\matcher\alias\LessThanMatcherAlias;


final class ToBeBelow implements Matcher
{

    use LessThanMatcherDelegatable;


    public function __construct($expected)
    {
        $this->lessThanMatcher = new ToBeLessThan($expected);
    }

}
