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

/**
 * Factory of matcher.
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
interface MatcherFactory
{
    /**
     * Create a matcher.
     *
     * @param string $name      matcher name
     * @param array  $arguments parameters for create
     *
     * @return \expect\matcher\ReportableMatcher
     */
    public function create($name, array $arguments = []);
}
