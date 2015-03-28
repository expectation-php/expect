<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeAn;

describe('ToBeAn', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeAn("string");
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match("foo");
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(11);
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeAn("string");
            $this->message = new FailedMessage();

            $this->expectedMessage  = "\nExpected 1 to be an string\n\n";
            $this->expectedMessage .= "    expected: string\n";
            $this->expectedMessage .= "         got: integer\n";
        });
        it('report failed message', function () {
            $this->matcher->match(1);
            $this->matcher->reportFailed($this->message);
            Assertion::same((string) $this->message, $this->expectedMessage);
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeAn("string");
            $this->message = new FailedMessage();

            $this->expectedMessage  = "\nExpected 'foo' not to be an string\n\n";
            $this->expectedMessage .= "    expected not: string\n";
            $this->expectedMessage .= "             got: string\n";
        });
        it('report failed message', function () {
            $this->matcher->match("foo");
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, $this->expectedMessage);
        });
    });

});
