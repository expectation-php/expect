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


final class ToMatch implements Matcher
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
        return (preg_match($this->expected, $this->actual) === 1);
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" to match ")
            ->appendText($this->expected);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" not to match ")
            ->appendText($this->expected);
    }

}