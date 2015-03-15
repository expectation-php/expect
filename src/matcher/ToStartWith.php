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


final class ToStartWith implements Matcher
{

    use ComparePattern;


    private $actual;
    private $pattern;


    public function __construct($expected)
    {
        $this->pattern = preg_quote($expected, "/");
        $this->patternMatcher = new ToMatch("/^{$this->pattern}/");
    }

    /**
     * {@inheritdoc}
     */
    public function match($actual)
    {
        $this->actual = $actual;
        return $this->patternMatcher->match($actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" to start with ")
            ->appendValue($this->pattern);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" not to start with ")
            ->appendValue($this->pattern);
    }

}
