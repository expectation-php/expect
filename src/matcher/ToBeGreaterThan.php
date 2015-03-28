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
 * Verify whether the value is greater than the value of the expected value.
 *
 * <code>
 * $matcher = new ToBeGreaterThan(100);
 * $matcher->match(100); //return true
 *
 * $matcher->match(1); //return false
 * </code>
 *
 * @package expect\matcher
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeGreaterThan implements ReportableMatcher
{

    /**
     * @var int|float
     */
    private $actual;

    /**
     * @var int|float
     */
    private $expected;

    /**
     * @param int|float $expected expected value
     */
    public function __construct($expected)
    {
        $this->expected = $expected;
    }

    /**
     * {@inheritdoc}
     */
    public function match($actual)
    {
        $this->actual = $actual;
        return $this->actual >= $this->expected;
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('Expected ')
            ->appendValue($this->actual)
            ->appendText(' to be greater than ')
            ->appendValue($this->expected)
            ->appendText("\n\n")
            ->appendText('    expected: >= ')
            ->appendValue($this->expected)
            ->appendText("\n")
            ->appendText('         got:    ')
            ->appendValue($this->actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('Expected ')
            ->appendValue($this->actual)
            ->appendText(' not to be greater than ')
            ->appendValue($this->expected)
            ->appendText("\n\n")
            ->appendText('    expected not: >= ')
            ->appendValue($this->expected)
            ->appendText("\n")
            ->appendText('             got:    ')
            ->appendValue($this->actual);
    }
}
