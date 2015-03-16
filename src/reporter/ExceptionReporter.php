<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expect\reporter;

use expect\FailedMessage;
use expect\ResultReporter;


class ExceptionReporter implements ResultReporter
{

    public function reportFailed(FailedMessage $message)
    {
        throw new FailedException($message);
    }

    public function reportNegativeFailed(FailedMessage $message)
    {
        throw new FailedException($message);
    }

}
