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
        $this->message = $this->message . $value;
        return $this;
    }

    public function __toString()
    {
        return $this->message;
    }

}
