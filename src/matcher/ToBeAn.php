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
 * Verify whether the value is of a type that expect.
 *
 * <code>
 * $matcher = new ToBeAn('string');
 * $matcher->match('foo'); //return true
 *
 * $matcher->match(1); //return false
 * </code>
 *
 * @package expect\matcher
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeAn implements ReportableMatcher
{

    /**
     * @var mixed
     */
    private $actual;

    /**
     * @var string
     */
    private $expected;

    /**
     * type of value
     *
     * @var string
     */
    private $actualType;

    /**
     * Create a new matcher
     *
     * @param $expected expected value
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
        $this->actualType = $this->detectType($this->actual);

        return $this->actualType === $this->expected;
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('Expected ')
            ->appendValue($this->actual)
            ->appendText(' to be an ')
            ->appendText($this->expected);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('Expected ')
            ->appendValue($this->actual)
            ->appendText(' not to be an ')
            ->appendText($this->expected);
    }

    /**
     * @param mixed $value
     * @return string type name
     */
    private function detectType($value)
    {
        $detectType = gettype($value);
        $detectType = ($detectType === 'double') ? 'float' : $detectType;

        return $detectType;
    }
}
