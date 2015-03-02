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

    private $actual;
    private $negated;
    private $factory;


    public function __construct(Factory $factory)
    {
        $this->actual = null;
        $this->negated = false;
        $this->factory = $factory;
    }

    public function actual($actual)
    {
        $this->actual = $actual;
        return $this;
    }

    public function not()
    {
        $this->negated = true;
        return $this;
    }

    protected function evaluate($name, array $arguments = [])
    {
        $matcher = $this->factory->create($name, $arguments);

        $matcherResult = $this->matcher->match($this->actual);
        $expected = $this->negated ? false : true;

        $result = $matcherResult !== $expected;

        return new Result($actual, $this->negated, $matcher, $result);
    }

    public function __call($name, array $arguments = [])
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        } else {
            return $this->evaluate($name, $arguments);
        }
    }

}
