<?php

namespace expect;


class FailedMessage implements Message
{

    /**
     * @var string
     */
    private $message;


    public function __construct()
    {
        $this->message = '';
    }

    public function appendText($text)
    {
        $this->message = $this->message . $text;
        return $this;
    }

    public function appendValue($value)
    {
        $appendValue = '';

        if (is_string($value)) {
            $appendValue = "'" . $value . "'";
        } else if (is_null($value)) {
            $appendValue = "null";
        } else if (is_bool($value)) {
            $appendValue = $this->boolToString($value);
        } else {
            $appendValue = rtrim(print_r($value, true));
        }

        $this->message = $this->message . $appendValue;
        return $this;
    }

    private function boolToString($value)
    {
        return $value === true ? 'true' : 'false';
    }

    public function __toString()
    {
        return $this->message;
    }

}
