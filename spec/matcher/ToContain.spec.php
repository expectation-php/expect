<?php

use expect\matcher\ToContain;
use expect\FailedMessage;
use Assert\Assertion;


describe('ToContain', function() {

    describe('#match', function() {
        context('when string', function() {
            beforeEach(function() {
                $this->matcher = new ToContain([ 'foo', 'bar' ]);
            });
            context('when match', function() {
                it('return true', function() {
                    $result = $this->matcher->match('foo bar');
                    Assertion::true($result);
                });
            });
            context('when unmatch', function() {
                it('return false', function() {
                    $result = $this->matcher->match('foo1');
                    Assertion::false($result);
                });
            });
        });
        context('when array', function() {
            beforeEach(function() {
                $this->matcher = new ToContain([ 'foo', 'bar' ]);
            });
            context('when match', function() {
                it('return true', function() {
                    $result = $this->matcher->match([ 'foo', 'bar' ]);
                    Assertion::true($result);
                });
            });
            context('when unmatch', function() {
                it('return false', function() {
                    $result = $this->matcher->match([ 'foo1' ]);
                    Assertion::false($result);
                });
            });
        });
    });
});
