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


final class ToBeGreaterThan implements Matcher
{

    private $actual;
    private $expected;
    private $actualPadding = 0;
    private $expectedPadding = 0;


    public function __construct($expected)
    {
        $this->expected = $expected;
        $this->actualPadding = 0;
        $this->expectedPadding = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function match($actual)
    {
        $this->actual = $actual;
        $this->calculatePadding();
        return $this->actual >= $this->expected;
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" to be greater than ")
            ->appendValue($this->expected)
            ->appendText("\n")
            ->appendText("expected: >= ")
            ->appendSpace($this->expectedPadding)
            ->appendValue($this->expected)
            ->appendText("\n")
            ->appendText("     got: ")
            ->appendSpace($this->actualPadding)
            ->appendValue($this->actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->actual)
            ->appendText(" not to be greater than ")
            ->appendValue($this->expected);
    }

    private function calculatePadding()
    {
        $actualLength = strlen(strval($this->actual));
        $expectedLength = strlen(strval($this->expected));

        if ($actualLength > $expectedLength) {
            $this->expectedPadding = $actualLength - $expectedLength;
        } else if ($actualLength < $expectedLength) {
            $this->actualPadding = ($expectedLength - $actualLength) + 3; // >=
        }
    }

}
