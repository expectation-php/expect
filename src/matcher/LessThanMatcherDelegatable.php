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


trait LessThanMatcherDelegatable
{

    /**
     * @var \expect\matcher\ToBeLessThan
     */
    private $lessThanMatcher;


    /**
     * {@inheritdoc}
     */
    public function match($actual)
    {
        return $this->lessThanMatcher->match($actual);
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        return $this->lessThanMatcher->reportFailed($message);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        return $this->lessThanMatcher->reportNegativeFailed($message);
    }

}
