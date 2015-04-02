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
 * Verify whether the value is less than the value of the expected value.
 *
 * <code>
 * $matcher = new ToBeLessThan(100);
 * $matcher->match(99); //return true
 *
 * $matcher->match(100); //return false
 * </code>
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeLessThan implements ReportableMatcher
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
     * Create a new matcher.
     *
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

        return $this->actual < $this->expected;
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $detail = $this->createDetailMessage();
        $message->appendText('Expected ')
            ->appendValue($this->actual)
            ->appendText(' to be less than ')
            ->appendValue($this->expected)
            ->appendText($detail);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $detail = $this->createDetailMessage(' not');
        $message->appendText('Expected ')
            ->appendValue($this->actual)
            ->appendText(' not to be less than ')
            ->appendValue($this->expected)
            ->appendText($detail);
    }

    private function createDetailMessage($prefixMessage = '')
    {
        $message = FailedMessage::fromString("\n\n");
        $message->appendText('    expected')
            ->appendText($prefixMessage)
            ->appendText(': < ')
            ->appendValue($this->expected)
            ->appendText("\n")
            ->appendSpace(strlen($prefixMessage))
            ->appendText('         got:   ')
            ->appendValue($this->actual);

        return (string) $message;
    }

}
