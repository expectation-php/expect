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


final class ToContain implements Matcher
{

    /**
     * @var string
     */
    private $type;

    /**
     * @var mixed
     */
    private $actual;

    /**
     * @var \expect\matcher\strategy\InclusionResult
     */
    private $matchResult;

    /**
     * @var array
     */
    private $expectValues;


    public function __construct($expected)
    {
        $this->expectValues = is_array($expected) ? $expected : [ $expected ];
    }

    /**
     * {@inheritdoc}
     */
    public function match($actual)
    {
        $this->actual = $actual;

        $strategy = $this->createStrategy();
        $this->matchResult = $strategy->match($this->expectValues);

        return $this->matchResult->isMatched();
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


    private function createStrategy()
    {
        $strategy = null;

        if (is_string($this->actual)) {
            $this->type = 'string';
            $strategy = new StringInclusionStrategy($this->actual);
        } else if (is_array($this->actual)) {
            $this->type = 'array';
            $strategy = new ArrayInclusionStrategy($this->actual);
        }

        return $strategy;
    }

}
