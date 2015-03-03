<?php

use expect\MatcherEvaluator;
use expect\matcher\toEqual;
use Prophecy\Prophet;
use Assert\Assertion;


describe('MatcherEvaluator', function() {

    describe('#__call', function() {
        beforeEach(function() {
            $this->prophet = new Prophet();

            $factory = $this->prophet->prophesize('expect\MatcherFactory');
            $factory->create('toEqual', [ true ])
                ->willReturn( new toEqual(true) );

            $this->evaluator = new MatcherEvaluator( $factory->reveal() );
        });
        context('when positive evaluate', function() {
            it('return expect\Result instance', function() {
                $result = $this->evaluator->actual(true)->toEqual(true);
                Assertion::isInstanceOf($result, 'expect\Result');
            });
        });
        context('when negative evaluate', function() {
            it('return expect\Result instance', function() {
                $result = $this->evaluator->actual(true)->not()->toEqual(true);
                Assertion::isInstanceOf($result, 'expect\Result');
            });
        });
    });

});
