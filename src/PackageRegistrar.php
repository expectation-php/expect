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

use expect\MatcherRegistry;

/**
 * Package registrar
 *
 * @package expect
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
interface PackageRegistrar
{

    /**
     * Register the matcher package.
     *
     * @param \expect\MatcherRegistry $registry matcher registry
     */
    public function registerTo(MatcherRegistry $registry);

}
