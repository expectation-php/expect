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

/**
 * Verify whether the value is no range.
 *
 * <code>
 * $matcher = new ToBeWithin([0, 10]);
 * $matcher->match(1); //return true
 *
 * $matcher->match(11); //return false
 * </code>
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeWithin implements ReportableMatcher
{
    /**
     * @var int|float
     */
    private $actual;

    /**
     * @var int|float
     */
    private $from;

    /**
     * @var int|float
     */
    private $to;

    /**
     * Create a new matcher.
     *
     * @param array $expected
     */
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
        $message->appendText('Expected ')
            ->appendValue($this->actual)
            ->appendText(' to be within ');

        $this->appendRange($message);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('Expected ')
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
