<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expect;

class FailedMessage implements Message
{
    /**
     * @var string
     */
    private $message;

    public function __construct($message = '')
    {
        $this->message = $message;
    }

    public function appendText($text)
    {
        $this->message = $this->message.$text;

        return $this;
    }

    public function appendSpace($length)
    {
        $this->message = $this->message.str_pad('', $length, ' ');

        return $this;
    }

    public function appendValue($value)
    {
        $appendValue = $this->stringify($value);
        $this->message = $this->message.$appendValue;

        return $this;
    }

    public function appendValues(array $values)
    {
        $appendValues = [];

        foreach ($values as $value) {
            $appendValues[] = $this->stringify($value);
        }

        $this->message = $this->message.implode(', ', $appendValues);

        return $this;
    }

    public function concat(FailedMessage $message)
    {
        $prefix = (string) $this;
        $suffix = (string) $message;
        $concatenatedMessage = trim($prefix)."\n".trim($suffix);

        return static::fromString($concatenatedMessage);
    }

    public static function fromString($value)
    {
        return new self($value);
    }

    private function boolToString($value)
    {
        return $value === true ? 'true' : 'false';
    }

    public function __toString()
    {
        return "\n".$this->message."\n";
    }

    private function stringify($value)
    {
        $appendValue = '';

        if (is_string($value)) {
            $appendValue = "'".$value."'";
        } elseif (is_null($value)) {
            $appendValue = 'null';
        } elseif (is_bool($value)) {
            $appendValue = $this->boolToString($value);
        } else {
            $appendValue = rtrim(print_r($value, true));
        }

        return $appendValue;
    }
}
