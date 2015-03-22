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


final class ToBeWithin implements Matcher
{

    private $actual;
    private $from;
    private $to;


    public function __construct($expected)
    {
        list($this->from, $this->to) = $expected;
    }

    /**
     * {@inheritdoc}
     */
    public function match($actual)
    {
        $this->actual = $actual;
        return ($this->actual >= $this->from && $this->actual <= $this->to);
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" to be within ")
            ->appendValue($this->from)
            ->appendText(" between ")
            ->appendValue($this->to);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" not to be within ")
            ->appendValue($this->from)
            ->appendText(" between ")
            ->appendValue($this->to);
    }

}