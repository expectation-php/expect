<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToStartWith;

describe('ToStartWith', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToStartWith('foo');
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match('foo');
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match('bar');
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToStartWith('foo');
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match('bar');
            $this->matcher->reportFailed($this->message);
            Assertion::same((string) $this->message, "Expected 'bar' to start with 'foo'");
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToStartWith('foo');
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match('foo');
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, "Expected 'foo' not to start with 'foo'");
        });
    });

});
