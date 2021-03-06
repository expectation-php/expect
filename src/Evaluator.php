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

use expect\matcher\ReportableMatcher;

/**
 * The evaluator.
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
interface Evaluator
{
    /**
     * Create the evaluator from matcher.
     *
     * @param \expect\matcher\ReportableMatcher
     *
     * @return Evaluator
     */
    public static function fromMatcher(ReportableMatcher $matcher);
}
