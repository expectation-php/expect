<?php

use Assert\Assertion;
use expect\Configuration;
use expect\context\EvaluateContext;
use Prophecy\Argument;
use Prophecy\Prophet;

describe('EvaluateContext', function () {
    describe('#evaluate', function () {
        context('when positive evaluate', function () {
            beforeEach(function () {
                $this->prophet = new Prophet();

                $this->actual = true;
                $this->expected = false;

                $matcher = $this->prophet->prophesize('expect\matcher\ReportableMatcher');
                $matcher->match($this->actual)->willReturn(false);
                $matcher->reportFailed(Argument::type('expect\FailedMessage'))
                    ->shouldBeCalled();

                $factory = $this->prophet->prophesize('expect\MatcherFactory');
                $factory->create('toEqual', [ $this->expected ])->willReturn($matcher->reveal());

                $reporter = $this->prophet->prophesize('expect\ResultReporter');
                $reporter->reportFailed(Argument::type('expect\FailedMessage'))
                    ->shouldBeCalled();

                $this->context = new EvaluateContext(
                    $factory->reveal(),
                    $reporter->reveal()
                );
                $this->context->actual($this->actual);
            });
            it('evaluate context', function () {
                $this->context->evaluate('toEqual', [ $this->expected ]);
                $this->prophet->checkPredictions();
            });
        });
        context('when negative evaluate', function () {
            beforeEach(function () {
                $this->prophet = new Prophet();

                $this->actual = true;
                $this->expected = true;

                $matcher = $this->prophet->prophesize('expect\matcher\ReportableMatcher');
                $matcher->match($this->actual)->willReturn(true);
                $matcher->reportNegativeFailed(Argument::type('expect\FailedMessage'))
                    ->shouldBeCalled();

                $factory = $this->prophet->prophesize('expect\MatcherFactory');
                $factory->create('toEqual', [ $this->expected ])->willReturn($matcher->reveal());

                $reporter = $this->prophet->prophesize('expect\ResultReporter');
                $reporter->reportNegativeFailed(Argument::type('expect\FailedMessage'))
                    ->shouldBeCalled();

                $this->context = new EvaluateContext(
                    $factory->reveal(),
                    $reporter->reveal()
                );
                $this->context->not();
                $this->context->actual($this->actual);
            });
            it('evaluate context', function () {
                $this->context->evaluate('toEqual', [ $this->expected ]);
                $this->prophet->checkPredictions();
            });
        });
    });
});
