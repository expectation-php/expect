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


class MatcherEvaluator implements Evaluator
{

    private $matcher;
    private $negated;


    public function __construct(Matcher $matcher)
    {
        $this->negated = false;
        $this->matcher = $matcher;
    }

    public function negated()
    {
        $this->negated = true;
        return $this;
    }

    public function evaluate($actual)
    {
        $matcherResult = $this->matcher->match($actual);
        $expected = $this->negated ? false : true;

        $result = $matcherResult === $expected;

        return new Result($actual, $this->negated, $matcher, $result);
    }

    /**
     * {@inheritdoc}
     */
    public static function fromMatcher(Matcher $matcher)
    {
        return new self($matcher);
    }

}
