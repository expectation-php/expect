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


final class ToPrint implements ReportableMatcher
{

    private $actual;
    private $expected;

    public function __construct($expected)
    {
        $this->expected = $expected;
    }

    public function match($actual)
    {
        ob_start();
        $actual();
        $this->actual = ob_get_clean();

        return $this->actual === $this->expected;
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('expected ')
            ->appendValue($this->expected)
            ->appendText(", got ")
            ->appendValue($this->actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('expected output other than ')
            ->appendValue($this->expected);
    }

}
