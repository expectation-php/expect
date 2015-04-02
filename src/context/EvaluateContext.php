<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace expect\context;

use expect\Context;
use expect\MatcherEvaluator;
use expect\MatcherFactory;
use expect\ResultReporter;

class EvaluateContext implements Context
{
    private $actual;
    private $negated;
    private $factory;
    private $reporter;

    public function __construct(MatcherFactory $factory, ResultReporter $reporter)
    {
        $this->actual = null;
        $this->negated = false;
        $this->factory = $factory;
        $this->reporter = $reporter;
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

    public function evaluate($name, $arguments = [])
    {
        $matcher = $this->factory->create($name, $arguments);

        $evaluator = MatcherEvaluator::fromMatcher($matcher);

        if ($this->negated) {
            $evaluator->negated();
        }

        $result = $evaluator->evaluate($this->actual);
        $result->reportTo($this->reporter);
    }

    public function __call($name, $arguments = [])
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        } else {
            $this->evaluate($name, $arguments);
        }
    }
}
