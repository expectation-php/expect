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


class ToBeTrue implements Matcher
{

    private $equalMatcher;


    public function __construct($expected)
    {
        $this->equalMatcher = new ToEqual(true);
    }

    /**
     * {@inheritdoc}
     */
    public function match($actual)
    {
        return $this->equalMatcher->match($actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        return $this->equalMatcher->reportFailed($message);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        return $this->equalMatcher->reportNegativeFailed($message);
    }

}
