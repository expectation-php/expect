<?php

use Assert\Assertion;
use expect\Matcher;
use expect\Result;
use expect\ResultReporter;
use expect\matcher\ReportableMatcher;
use expect\FailedMessage;
use Prophecy\Argument;
use Prophecy\Prophet;

describe(Result::class, function () {

    describe('#isPassed', function () {
        beforeEach(function () {
            $this->prophet = new Prophet();

            $matcher = $this->prophet->prophesize(ReportableMatcher::class);
            $this->matcher = $matcher->reveal();
        });
        context('when passed', function () {
            it('return true', function () {
                $result = new Result(true, false, $this->matcher, true);
                Assertion::true($result->isPassed());
            });
        });
        context('when failed', function () {
            it('return false', function () {
                $result = new Result(true, false, $this->matcher, false);
                Assertion::false($result->isPassed());
            });
        });
    });

    describe('#isFailed', function () {
        beforeEach(function () {
            $this->prophet = new Prophet();

            $matcher = $this->prophet->prophesize(ReportableMatcher::class);
            $this->matcher = $matcher->reveal();
        });
        context('when passed', function () {
            it('return false', function () {
                $result = new Result(true, false, $this->matcher, true);
                Assertion::false($result->isFailed());
            });
        });
        context('when failed', function () {
            it('return true', function () {
                $result = new Result(true, false, $this->matcher, false);
                Assertion::true($result->isFailed());
            });
        });
    });

    describe('#reportTo', function () {
        context('when positive failed', function () {
            beforeEach(function () {
                $this->prophet = new Prophet();

                $matcher = $this->prophet->prophesize(ReportableMatcher::class);
                $this->result = new Result(true, false, $matcher->reveal(), false);

                $resultReporter = $this->prophet->prophesize(ResultReporter::class);
                $resultReporter->reportFailed(Argument::type(FailedMessage::class))
                    ->shouldBeCalled();

                $this->resultReporter = $resultReporter->reveal();
            });
            it('report by result reporter', function () {
                $this->result->reportTo($this->resultReporter);
                $this->prophet->checkPredictions();
            });
        });
        context('when nagative failed', function () {
            beforeEach(function () {
                $this->prophet = new Prophet();

                $matcher = $this->prophet->prophesize(ReportableMatcher::class);
                $this->result = new Result(true, true, $matcher->reveal(), false);

                $resultReporter = $this->prophet->prophesize(ResultReporter::class);
                $resultReporter->reportNegativeFailed(Argument::type(FailedMessage::class))
                    ->shouldBeCalled();

                $this->resultReporter = $resultReporter->reveal();
            });
            it('report by result reporter', function () {
                $this->result->reportTo($this->resultReporter);
                $this->prophet->checkPredictions();
            });
        });
    });

});
