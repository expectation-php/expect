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
 * To verify whether consistent with the results value is expected.
 *
 * @package expect
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
interface Matcher
{
    /**
     * Verify whether the value is consistent with what is expected.
     * Returns true if the value matches the contents to be expected.
     *
     * @param mixed $actual value of actual
     *
     * @return bool results of evaluation
     */
    public function match($actual);
}
