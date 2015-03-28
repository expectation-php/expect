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

use Countable;

/**
 * Container of matcher.
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
interface MatcherContainer extends Countable
{
    /**
     * Find the matcher class by name.
     * Returns true if it is found.
     *
     * @param string matcher name
     *
     * @return bool
     */
    public function has($name);

    /**
     * Get the matcher class.
     *
     * @param string matcher name
     *
     * @return \expect\package\MatcherClass
     */
    public function get($name);
}
