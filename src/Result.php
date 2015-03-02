<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expect;


class Result
{

    private $actual;
    private $negated;
    private $matcher;
    private $result;


    public function __construct($actual, $negated, Matcher $matcher, $result)
    {
        $this->actual = $actual;
        $this->negated = $negated;
        $this->matcher = $matcher;
        $this->result = $result;
    }

    public function isPassed()
    {
        return $this->result;
    }

    public function isFailed()
    {
        return $this->isPassed() === false;
    }

    public function reportTo(Reporter $reporter)
    {
        $reporter->report($this);
    }

}
