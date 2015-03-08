<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expect\fixture\reporter;


use expect\Result;
use expect\ResultReporter;
use expect\FailedMessage;


class CustomReporter implements ResultReporter
{

//    public function report(Result $result)
//    {
//    }

    public function reportFailed(FailedMessage $message)
    {
    }

    public function reportNegativeFailed(FailedMessage $message)
    {
    }

}
