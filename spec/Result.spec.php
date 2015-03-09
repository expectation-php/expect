<?php

use expect\Matcher;
use expect\Result;
use Prophecy\Prophet;
use Prophecy\Argument;
use Assert\Assertion;


describe('Result', function() {

    describe('#isPassed', function() {
        beforeEach(function() {
            $this->prophet = new Prophet();

            $matcher = $this->prophet->prophesize('expect\Matcher');
            $this->matcher = $matcher->reveal();
        });
        context('when passed', function() {
            it('return true', function() {
                $result = new Result(true, false, $this->matcher, true);
                Assertion::true($result->isPassed());
            });
        });
        context('when failed', function() {
            it('return false', function() {
                $result = new Result(true, false, $this->matcher, false);
                Assertion::false($result->isPassed());
            });
        });
    });

    describe('#isFailed', function() {
        beforeEach(function() {
            $this->prophet = new Prophet();

            $matcher = $this->prophet->prophesize('expect\Matcher');
            $this->matcher = $matcher->reveal();
        });
        context('when passed', function() {
            it('return false', function() {
                $result = new Result(true, false, $this->matcher, true);
                Assertion::false($result->isFailed());
            });
        });
        context('when failed', function() {
            it('return true', function() {
                $result = new Result(true, false, $this->matcher, false);
                Assertion::true($result->isFailed());
            });
        });
    });

    describe('#reportTo', function() {
        context('when positive failed', function() {
            beforeEach(function() {
                $this->prophet = new Prophet();

                $matcher = $this->prophet->prophesize('expect\Matcher');
                $this->result = new Result(true, false, $matcher->reveal(), false);

                $resultReporter = $this->prophet->prophesize('expect\ResultReporter');
                $resultReporter->reportFailed(Argument::type('expect\FailedMessage'))
                    ->shouldBeCalled();

                $this->resultReporter = $resultReporter->reveal();
            });
            it('report by result reporter', function() {
                $this->result->reportTo($this->resultReporter);
                $this->prophet->checkPredictions();
            });
        });
        context('when nagative failed', function() {
            beforeEach(function() {
                $this->prophet = new Prophet();

                $matcher = $this->prophet->prophesize('expect\Matcher');
                $this->result = new Result(true, true, $matcher->reveal(), false);

                $resultReporter = $this->prophet->prophesize('expect\ResultReporter');
                $resultReporter->reportNegativeFailed(Argument::type('expect\FailedMessage'))
                    ->shouldBeCalled();

                $this->resultReporter = $resultReporter->reveal();
            });
            it('report by result reporter', function() {
                $this->result->reportTo($this->resultReporter);
                $this->prophet->checkPredictions();
            });
        });
    });

});
