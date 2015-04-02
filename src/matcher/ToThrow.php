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

use Exception;
use expect\FailedMessage;

/**
 * Verify whether an exception is thrown.
 *
 * <code>
 * $matcher = new ToThrow('RuntimeException');
 * $matcher->match(function() { throw new RuntimeException() }); //return true
 *
 * $matcher->match(function() { throw new Exception() }); //return false
 * <code>
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToThrow implements ReportableMatcher
{
    /**
     * @var callable
     */
    private $actual;

    /**
     * @var string
     */
    private $expected;

    /**
     * @var Exception|null
     */
    private $thrownException;

    /**
     * Create a new matcher.
     *
     * @param string $expected
     */
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

        $message->appendText('Expected ')
            ->appendText($this->expected)
            ->appendText(' to be thrown, ')
            ->appendText($explanation);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('Expected ')
            ->appendText($this->expected)
            ->appendText(' not to be thrown');
    }
}
