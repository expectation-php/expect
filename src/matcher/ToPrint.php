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
 * Verify the output in the expected value
 *
 * <code>
 * $matcher = new ToPrint('foo');
 * $matcher->match(function() { echo 'foo' }); //return true
 *
 * $matcher->match(function() { echo 'bar' }); //return false
 * <code>
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToPrint implements ReportableMatcher
{

    /**
     * @var callable
     */
    private $actual;

    /**
     * @var string
     */
    private $expected;

    /**
     * Create a new matcher
     * @param string $expected
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
        ob_start();
        $actual();
        $this->actual = ob_get_clean();

        return $this->actual === $this->expected;
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('Expected ')
            ->appendValue($this->expected)
            ->appendText(', got ')
            ->appendValue($this->actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('Expected output other than ')
            ->appendValue($this->expected);
    }
}
