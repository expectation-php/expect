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


final class ToBeGreaterThan implements Matcher
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
        return $this->actual >= $this->expected;
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        //expected %s to be greater than %s
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" to be greater than ")
            ->appendValue($this->expected);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        //expected %s to be greater than %s
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" not to be greater than ")
            ->appendValue($this->expected);
    }

}
