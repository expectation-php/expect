<?php

namespace expect;


interface Matcher
{

    /**
     * @param mixed $actual
     * @return bool
     */
    public function match($actual);

    public function reportFailed(FailedMessage $message);

    public function reportNegativeFailed(FailedMessage $message);

}
