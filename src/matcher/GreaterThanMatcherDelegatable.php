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


trait GreaterThanMatcherDelegatable
{

    /**
     * @var \expect\matcher\ToBeGreaterThan
     */
    private $greaterThanMatcher;


    /**
     * {@inheritdoc}
     */
    public function match($actual)
    {
        return $this->greaterThanMatcher->match($actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        return $this->greaterThanMatcher->reportFailed($message);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        return $this->greaterThanMatcher->reportNegativeFailed($message);
    }

}
