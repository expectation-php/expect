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
    private $context;


    public function __construct(Context $context)
    {
        $this->actual = null;
        $this->negated = false;
        $this->context = $context;
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
        $factory = $this->context->getMatcherFactory();
        $matcher = $factory->create($name, $arguments);

        $matcherResult = $matcher->match($this->actual);
        $expected = $this->negated ? false : true;

        $result = $matcherResult === $expected;

        return new Result($this->actual, $this->negated, $matcher, $result);
    }

    public function __call($name, array $arguments = [])
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        } else {
            return $this->evaluate($name, $arguments);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function fromContext(Context $context)
    {
        return new self($context);
    }

}
