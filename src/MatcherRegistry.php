<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expect;

use expect\package\MatcherClass;

/**
 * Container that register the matcher class.
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
interface MatcherRegistry extends MatcherContainer
{
    /**
     * Register the matcher class.
     *
     * @param \expect\package\MatcherClass $matcherClass matcher class
     */
    public function register(MatcherClass $matcherClass);
}
