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
use \Exception;


final class ToThrow implements Matcher
{

    private $actual;
    private $expected;
    private $thrownException;


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

        try {
            $actual();
        } catch (Exception $exception) {
            $this->thrownException = $exception;
        }

        return $this->thrownException instanceof $this->expected;
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $explanation = 'none thrown';

        if ($this->thrownException) {
            $class = get_class($this->thrownException);
            $explanation = "got $class";
        }

        $message->appendText('expected ')
            ->appendText($this->expected)
            ->appendText(' to be thrown, ')
            ->appendText($explanation);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendText($this->expected)
            ->appendText(' not to be thrown');
    }

}
