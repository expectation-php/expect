<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace expect\matcher;

use expect\Matcher;
use expect\FailedMessage;

/**
 * Interface ReportableMatcher.
 */
interface ReportableMatcher extends Matcher
{
    /**
     * Report the reason for the failure of positive evaluation.
     *
     * @param expect\FailedMessage failed message
     */
    public function reportFailed(FailedMessage $message);

    /**
     * Report the reason for the failure of negative evaluation.
     *
     * @param expect\FailedMessage failed message
     */
    public function reportNegativeFailed(FailedMessage $message);
}
