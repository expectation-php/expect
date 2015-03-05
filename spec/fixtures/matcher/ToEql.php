<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */


namespace expect\matcher\fixture;


use expect\Matcher;
use expect\FailedMessage;


class ToEql implements Matcher
{

    private $actual;
    private $expected;

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
        $message->appendText('expected ')
            ->appendValue($this->expected)
            ->appendText("\n")
            ->appendText("     got ")
            ->appendValue($this->actual)
            ->appendText("\n");
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('expected not ')
            ->appendValue($this->expected)
            ->appendText("\n")
            ->appendText("         got ")
            ->appendValue($this->actual)
            ->appendText("\n");
    }

}
