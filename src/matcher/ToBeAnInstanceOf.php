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


class ToBeAnInstanceOf implements Matcher
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

        return $this->actual instanceof $this->expected;
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $actual = $this->actualValue();

        $message->appendText('expected ')
            ->appendText($actual)
            ->appendText(" to be an instance of ")
            ->appendText($this->expected);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $actual = $this->actualValue();

        $message->appendText('expected ')
            ->appendText($actual)
            ->appendText(" not to be an instance of ")
            ->appendText($this->expected);
    }

    private function actualValue()
    {
        $actual = get_class($this->actual);
        $actual = ($actual === false) ? $this->actual : $actual;

        return $actual;
    }

}
