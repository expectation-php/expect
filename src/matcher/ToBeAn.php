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


final class ToBeAn implements Matcher
{

    private $actual;
    private $expected;
    private $actualType;


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
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" to be an ")
            ->appendText($this->expected);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" not to be an ")
            ->appendText($this->expected);
    }

    private function detectType($value)
    {
        $detectType = gettype($value);
        $detectType = ($detectType === 'double') ? 'float' : $detectType;

        return $detectType;
    }

}
