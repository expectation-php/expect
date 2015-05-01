<?php

use Assert\Assertion;
use expect\Configuration;
use expect\context\EvaluateContext;
use expect\matcher\ReportableMatcher;
use expect\ResultReporter;
use expect\FailedMessage;
use expect\MatcherFactory;
use Prophecy\Argument;
use Prophecy\Prophet;

describe(EvaluateContext::class, function () {
    describe('#evaluate', function () {
        context('when positive evaluate', function () {
            beforeEach(function () {
                $this->prophet = new Prophet();

                $this->actual = true;
                $this->expected = false;

                $matcher = $this->prophet->prophesize(ReportableMatcher::class);
                $matcher->match($this->actual)->willReturn(false);
                $matcher->reportFailed(Argument::type(FailedMessage::class))
                    ->shouldBeCalled();

                $factory = $this->prophet->prophesize(MatcherFactory::class);
                $factory->create('toEqual', [ $this->expected ])->willReturn($matcher->reveal());

                $reporter = $this->prophet->prophesize(ResultReporter::class);
                $reporter->reportFailed(Argument::type(FailedMessage::class))
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

                $matcher = $this->prophet->prophesize(ReportableMatcher::class);
                $matcher->match($this->actual)->willReturn(true);
                $matcher->reportNegativeFailed(Argument::type(FailedMessage::class))
                    ->shouldBeCalled();

                $factory = $this->prophet->prophesize(MatcherFactory::class);
                $factory->create('toEqual', [ $this->expected ])->willReturn($matcher->reveal());

                $reporter = $this->prophet->prophesize(ResultReporter::class);
                $reporter->reportNegativeFailed(Argument::type(FailedMessage::class))
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
