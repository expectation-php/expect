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
 * Euqal matcher.
 *
 * <code>
 * $matcher = new ToEqual(100);
 * $matcher->match(100); //return true
 *
 * $matcher = new ToEqual(100);
 * $matcher->match(99); //return false
 * <code>
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToEqual implements ReportableMatcher
{

    /**
     * @var mixed
     */
    private $actual;

    /**
     * @var mixed
     */
    private $expected;

    /**
     * @param mixed $expected expected value
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

        return $this->actual === $this->expected;
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText("Expected ")
            ->appendValue($this->actual)
            ->appendText(' to be ')
            ->appendValue($this->expected)
            ->appendText("\n\n")
            ->appendText('    expected: ')
            ->appendValue($this->expected)
            ->appendText("\n")
            ->appendText('         got: ')
            ->appendValue($this->actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText("Expected ")
            ->appendValue($this->actual)
            ->appendText(' not to be ')
            ->appendValue($this->expected)
            ->appendText("\n\n")
            ->appendText('    expected not: ')
            ->appendValue($this->expected)
            ->appendText("\n")
            ->appendText('             got: ')
            ->appendValue($this->actual);
    }
}
