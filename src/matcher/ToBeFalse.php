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
use expect\matcher\EqualMatcherDelegatable;


final class ToBeFalse implements Matcher
{

    use EqualMatcherDelegatable;

    public function __construct()
    {
        $this->equalMatcher = new ToEqual(false);
    }

}
