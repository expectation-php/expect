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


final class ToBeFalsey implements ReportableMatcher
{

    /**
     * @var mixed
     */
    private $actual;

    /**
     * {@inheritdoc}
     */
    public function match($actual)
    {
        return $this->matchFalsey($actual) === false;
    }

    public function matchFalsey($actual)
    {
        $this->actual = $actual;

        if (is_bool($this->actual)) {
            return $this->actual !== false;
        }

        return isset($this->actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('Expected falsey value, got ')
            ->appendValue($this->actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('Expected truthy value, got ')
            ->appendValue($this->actual);
    }

}
