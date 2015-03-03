<?php

use expect\MatcherEvaluator;
use expect\matcher\toEqual;
use Prophecy\Prophet;
use Assert\Assertion;


describe('MatcherEvaluator', function() {

    describe('#__call', function() {
        context('when positive evaluate', function() {
            context('when passed', function() {
                beforeEach(function() {
                    $this->prophet = new Prophet();

                    $factory = $this->prophet->prophesize('expect\MatcherFactory');
                    $factory->create('toEqual', [ true ])
                        ->willReturn( new toEqual(true) );

                    $this->evaluator = new MatcherEvaluator( $factory->reveal() );
                    $this->result = $this->evaluator->actual(true)->toEqual(true);
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

                    $factory = $this->prophet->prophesize('expect\MatcherFactory');
                    $factory->create('toEqual', [ false ])
                        ->willReturn( new toEqual(false) );

                    $this->evaluator = new MatcherEvaluator( $factory->reveal() );
                    $this->result = $this->evaluator->actual(true)->toEqual(false);
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
            beforeEach(function() {
                $this->prophet = new Prophet();

                $factory = $this->prophet->prophesize('expect\MatcherFactory');
                $factory->create('toEqual', [ true ])
                    ->willReturn( new toEqual(true) );

                $this->evaluator = new MatcherEvaluator( $factory->reveal() );
            });
            it('return expect\Result instance', function() {
                $result = $this->evaluator->actual(true)->not()->toEqual(true);
                Assertion::isInstanceOf($result, 'expect\Result');
            });
        });
    });

});
