<?php

use expect\MatcherEvaluator;
use Prophecy\Prophet;
use Assert\Assertion;


describe('MatcherEvaluator', function() {
    describe('#evaluate', function() {
        context('when positive evaluate', function() {
            context('when passed', function() {
                beforeEach(function() {
                    $this->prophet = new Prophet();

                    $actual = true;

                    $matcher = $this->prophet->prophesize('expect\Matcher');
                    $matcher->match($actual)->willReturn(true);

                    $matcherStub = $matcher->reveal();

                    $evaluator = MatcherEvaluator::fromMatcher($matcherStub);
                    $this->result = $evaluator->evaluate($actual);
                });
                it('return expect\Result instance', function() {
                    Assertion::isInstanceOf($this->result, 'expect\Result');
                });
                it('return passed result', function() {
                    Assertion::true($this->result->isPassed());
                });
            });
            context('when failed', function() {
                beforeEach(function() {
                    $this->prophet = new Prophet();

                    $actual = true;

                    $matcher = $this->prophet->prophesize('expect\Matcher');
                    $matcher->match($actual)->willReturn(false);

                    $matcherStub = $matcher->reveal();

                    $evaluator = MatcherEvaluator::fromMatcher($matcherStub);
                    $this->result = $evaluator->evaluate($actual);
                });
                it('return expect\Result instance', function() {
                    Assertion::isInstanceOf($this->result, 'expect\Result');
                });
                it('return failed result', function() {
                    Assertion::false($this->result->isPassed());
                });
            });
        });
        context('when negative evaluate', function() {
            context('when passed', function() {
                beforeEach(function() {
                    $this->prophet = new Prophet();

                    $actual = true;

                    $matcher = $this->prophet->prophesize('expect\Matcher');
                    $matcher->match($actual)->willReturn(false);

                    $matcherStub = $matcher->reveal();

                    $evaluator = MatcherEvaluator::fromMatcher($matcherStub);
                    $this->result = $evaluator->negated()->evaluate($actual);
                });
                it('return expect\Result instance', function() {
                    Assertion::isInstanceOf($this->result, 'expect\Result');
                });
                it('return passed result', function() {
                    Assertion::true($this->result->isPassed());
                });
            });
            context('when failed', function() {
                beforeEach(function() {
                    $this->prophet = new Prophet();

                    $actual = true;

                    $matcher = $this->prophet->prophesize('expect\Matcher');
                    $matcher->match($actual)->willReturn(true);

                    $matcherStub = $matcher->reveal();

                    $evaluator = MatcherEvaluator::fromMatcher($matcherStub);
                    $this->result = $evaluator->negated()->evaluate($actual);
                });
                it('return expect\Result instance', function() {
                    Assertion::isInstanceOf($this->result, 'expect\Result');
                });
                it('return passed result', function() {
                    Assertion::false($this->result->isPassed());
                });
            });
        });
    });
});
