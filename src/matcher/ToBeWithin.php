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

use expect\FailedMessage;

final class ToBeWithin implements ReportableMatcher
{
    private $actual;
    private $from;
    private $to;

    public function __construct($expected)
    {
        list($this->from, $this->to) = $expected;
    }

    /**
     * {@inheritdoc}
     */
    public function match($actual)
    {
        $this->actual = $actual;

        return ($this->actual >= $this->from && $this->actual <= $this->to);
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(' to be within ');

        $this->appendRange($message);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(' not to be within ');

        $this->appendRange($message);
    }

    private function appendRange(FailedMessage $message)
    {
        $message->appendValue($this->from)
            ->appendText(' between ')
            ->appendValue($this->to);
    }
}
