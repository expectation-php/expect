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
 * Verify key exists
 *
 * <code>
 * $matcher = new ToHaveKey('foo');
 * $matcher->match([ 'foo' => 1 ]); //return true
 *
 * $matcher->match([ 'bar' => 1 ]); //return false
 * <code>
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToHaveKey implements ReportableMatcher
{
    /**
     * @var array
     */
    private $actual;

    /**
     * @var string|int
     */
    private $expected;

    /**
     * @param string|int $expected
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

        return array_key_exists($this->expected, $this->actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('Expected array to have the key ')
            ->appendValue($this->expected);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('Expected array not to have the key ')
            ->appendValue($this->expected);
    }
}
