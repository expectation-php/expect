<?php

use expect\matcher\ToEndWith;
use expect\FailedMessage;
use Assert\Assertion;


describe('ToEndWith', function() {

    describe('#match', function() {
        beforeEach(function() {
            $this->matcher = new ToEndWith('foo');
        });
        context('when match', function() {
            it('return true', function() {
                $result = $this->matcher->match('foo');
                Assertion::true($result);
            });
        });
        context('when unmatch', function() {
            it('return false', function() {
                $result = $this->matcher->match('bar');
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function() {
        beforeEach(function() {
            $this->matcher = new ToEndWith('foo');
            $this->message = new FailedMessage();
        });
        it('report failed message', function() {
            $this->matcher->match('bar');
            $this->matcher->reportFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected 'bar' to end with 'foo'\n");
        });
    });

    describe('#reportNegativeFailed', function() {
        beforeEach(function() {
            $this->matcher = new ToEndWith('foo');
            $this->message = new FailedMessage();
        });
        it('report failed message', function() {
            $this->matcher->match('foo');
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected 'foo' not to end with 'foo'\n");
        });
    });

});