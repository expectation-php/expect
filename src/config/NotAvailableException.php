<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expect\config;

use RuntimeException;

class NotAvailableException extends RuntimeException
{

    public static function createForReporter($interface)
    {
        return new self("Reporter is not available.\n
            Because it is because do not implement the {$interface}.");
    }

    public static function createForPackage($interface)
    {
        return new self("Package is not available.\n
            Because it is because do not implement the {$interface}.");
    }

}
