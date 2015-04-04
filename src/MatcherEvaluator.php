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

use expect\matcher\ReportableMatcher;

/**
 * Evaluate the matcher.
 *
 * @method boolean toEqual() toEqual(mixed $expected)
 * @method boolean toBe() toBe(mixed $expected)
 * @method boolean toBeTrue() toBeTrue()
 * @method boolean toBeTruthy() toBeTruthy()
 * @method boolean toBeFalse() toBeFalse()
 * @method boolean toBeFalsy() toBeFalsy()
 * @method boolean toBeNull() toBeNull()
 * @method boolean toBeA() toBeA(string $expected)
 * @method boolean toBeAn() toBeAn(string $expected)
 * @method boolean toBeString() toBeString()
 * @method boolean toBeInteger() toBeInteger()
 * @method boolean toBeFloat() toBeFloat()
 * @method boolean toBeBoolean() toBeBoolean()
 * @method boolean toBeAnInstanceOf() toBeAnInstanceOf(string $expected)
 * @method boolean toThrow() toThrow(string $expected)
 * @method boolean toHaveLength() toHaveLength(integer $expected)
 * @method boolean toBeEmpty() toBeEmpty()
 * @method boolean toPrint() toPrint(string $expected)
 * @method boolean toMatch() toMatch(string $expected)
 * @method boolean toStartWith() toStartWith(string $expected)
 * @method boolean toEndWith() toEndWith(string $expected)
 * @method boolean toContain() toContain(string $expected)
 * @method boolean toHaveKey() toHaveKey(string $expected)
 * @method boolean toBeGreaterThan() toBeGreaterThan(integer $expected)
 * @method boolean toBeLessThan() toBeLessThan(integer $expected)
 * @method boolean toBeAbove() toBeAbove(integer $expected)
 * @method boolean toBeBelow() toBeBelow(integer $expected)
 * @method boolean toBeWithin() toBeWithin(integer $from, integer $to)
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
class MatcherEvaluator implements Evaluator
{
    /**
     * @var \expect\matcher\ReportableMatcher
     */
    private $matcher;

    /**
     * @var bool
     */
    private $negated;

    /**
     * Create a matcher evaluator.
     *
     * @param \expect\matcher\ReportableMatcher $matcher The use matcher
     */
    public function __construct(ReportableMatcher $matcher)
    {
        $this->negated = false;
        $this->matcher = $matcher;
    }

    /**
     * Change state to nagative evaluation.
     *
     * @return MatcherEvaluator
     */
    public function negated()
    {
        $this->negated = true;

        return $this;
    }

    /**
     * Evaluate the value of actual.
     *
     * @param mixed $actual value of actual
     *
     * @return \expect\Result
     */
    public function evaluate($actual)
    {
        $matcherResult = $this->matcher->match($actual);
        $expected = $this->negated ? false : true;

        $result = $matcherResult === $expected;

        return new Result($actual, $this->negated, $this->matcher, $result);
    }

    /**
     * {@inheritdoc}
     */
    public static function fromMatcher(ReportableMatcher $matcher)
    {
        return new self($matcher);
    }
}
