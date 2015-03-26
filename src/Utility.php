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
 * Utility function for php5.6 or higher.
 *
 * <code>
 * <?php
 * use function expect\expect;
 *
 * expect($actual)->toBeTrue();
 * expect($actual)->toBeFalse();
 * ?>
 * </code>
 *
 * @param mixed $actual
 *
 * @return \expect\Context
 */
function expect($actual)
{
    return Expect::that($actual);
}
