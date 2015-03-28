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

class Result
{
    /**
     * @var mixed
     */
    private $actual;

    /**
     * @var bool
     */
    private $negated;

    /**
     * @var \expect\matcher\ReportableMatcher
     */
    private $matcher;

    /**
     * @var bool
     */
    private $result;

    public function __construct($actual, $negated, ReportableMatcher $matcher, $result)
    {
        $this->actual = $actual;
        $this->negated = $negated;
        $this->matcher = $matcher;
        $this->result = $result;
    }

    public function isPassed()
    {
        return $this->result;
    }

    public function isFailed()
    {
        return $this->isPassed() === false;
    }

    public function reportTo(ResultReporter $reporter)
    {
        if ($this->isPassed()) {
            return;
        }
        $this->reportFailed($reporter);
    }

    private function reportFailed(ResultReporter $reporter)
    {
        $message = new FailedMessage();

        if ($this->negated) {
            $this->matcher->reportNegativeFailed($message);
            $reporter->reportNegativeFailed($message);
        } else {
            $this->matcher->reportFailed($message);
            $reporter->reportFailed($message);
        }
    }
}
