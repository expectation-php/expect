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


final class ToBeTruthy implements Matcher
{

    const NEGATED_MATCH_TYPE = 'falsey';

    /**
     * @var mixed
     */
    private $actual;

    /**
     * {@inheritdoc}
     */
    public function match($actual)
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
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
    }

}
