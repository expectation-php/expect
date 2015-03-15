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
use Countable;


final class ToHaveLength implements Matcher
{

    private $actual;
    private $expected;
    private $type;
    private $length;


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

        if (is_string($this->actual) === true) {
            $this->type = 'string';
            $this->length = mb_strlen($this->actual);
        } else if (is_array($this->actual) === true) {
            $this->type = 'array';
            $this->length = count($this->actual);
        } else if ($this->actual instanceof Countable) {
            $this->type = get_class($that);
            $this->length = count($this->actual);
        }

        return ($this->length === $this->expected);
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendText($this->type)
            ->appendText(" to have a length of ")
            ->appendText($this->expected);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendText($this->type)
            ->appendText(" not to have a length of ")
            ->appendText($this->expected);
    }

}
