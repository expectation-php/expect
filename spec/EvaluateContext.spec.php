<?php

use expect\Configuration;
use expect\EvaluateContext;
use Assert\Assertion;
use Prophecy\Prophet;


describe('EvaluateContext', function() {
    beforeEach(function() {
        $this->prophet = new Prophet();

        $factory = $this->prophet->prophesize('expect\MatcherFactory');
        $reporter = $this->prophet->prophesize('expect\ResultReporter');

        $this->context = new EvaluateContext(
            $factory->reveal(),
            $reporter->reveal()
        );
    });
    describe('#getMatcherFactory', function() {
        it('return expect\MatcherFactory', function() {
            Assertion::isInstanceOf($this->context->getMatcherFactory(), 'expect\MatcherFactory');
        });
    });
    describe('#getResultReporter', function() {
        it('return expect\ResultReporter', function() {
            Assertion::isInstanceOf($this->context->getResultReporter(), 'expect\ResultReporter');
        });
    });
});
