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
 * Class ToMatch.
 */
final class ToMatch implements ReportableMatcher
{
    /**
     * @var string
     */
    private $actual;

    /**
     * @var string
     */
    private $expected;

    /**
     * @param string $expected String of a regular expression
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
        $patternMatcher = new PatternMatcher($this->expected);

        return $patternMatcher->match($this->actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" to match ")
            ->appendText($this->expected);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" not to match ")
            ->appendText($this->expected);
    }
}
