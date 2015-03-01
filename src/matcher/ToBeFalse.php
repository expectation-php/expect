<?php

namespace expect\matcher;


use expect\Matcher;
use expect\FailedMessage;


class ToBeFalse implements Matcher
{

    private $equalMatcher;


    public function __construct()
    {
        $this->equalMatcher = new ToEqual(false);
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
