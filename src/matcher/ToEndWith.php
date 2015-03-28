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

use expect\FailedMessage;

/**
 * Class ToEndWith.
 */
final class ToEndWith implements ReportableMatcher
{
    /**
     * @var string
     */
    private $actual;

    /**
     * @var string
     */
    private $pattern;

    /**
     * @param string $expected pattern keyword
     */
    public function __construct($expected)
    {
        $this->pattern = preg_quote($expected, '/');
    }

    /**
     * {@inheritdoc}
     */
    public function match($actual)
    {
        $this->actual = $actual;
        $patternMatcher = new PatternMatcher("/{$this->pattern}$/");

        return $patternMatcher->match($actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(' to end with ')
            ->appendValue($this->pattern);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(' not to end with ')
            ->appendValue($this->pattern);
    }
}
