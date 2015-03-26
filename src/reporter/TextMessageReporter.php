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

class TextMessageReporter implements ResultReporter
{
    public function reportFailed(FailedMessage $message)
    {
        echo (string) $message;
    }

    public function reportNegativeFailed(FailedMessage $message)
    {
        echo (string) $message;
    }
}
