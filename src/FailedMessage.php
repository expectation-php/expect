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

/**
 * Message when validation fails.
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
class FailedMessage implements Message
{
    /**
     * @var string
     */
    private $message;

    /**
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

    /**
     * Append the text to the last.
     *
     * @param string $text
     *
     * @return $this
     */
    public function appendText($text)
    {
        $this->message = $this->message.$text;

        return $this;
    }

    /**
     * Append the length space.
     *
     * @param int $length
     *
     * @return $this
     */
    public function appendSpace($length)
    {
        $paddingLength = (int) $length;
        $this->message = $this->message.str_pad('', $paddingLength, ' ');

        return $this;
    }

    /**
     * Append the value to the last.
     *
     * @param mixed $value
     *
     * @return $this
     */
    public function appendValue($value)
    {
        $appendValue = $this->stringify($value);
        $this->message = $this->message.$appendValue;

        return $this;
    }

    /**
     * Append the values to the last.
     *
     * @param array $values
     *
     * @return $this
     */
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
        return $this->message;
    }

    private function stringify($value)
    {
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
