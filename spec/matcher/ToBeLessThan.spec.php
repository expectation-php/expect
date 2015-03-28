<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeLessThan;

describe('ToBeLessThan', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeLessThan(100);
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match(99);
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(100);
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeLessThan(99);
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match(100);
            $this->matcher->reportFailed($this->message);

            $this->expectedMessage  = "Expected 100 to be less than 99\n\n";
            $this->expectedMessage .= "    expected: < 99\n";
            $this->expectedMessage .= "         got:   100";

            Assertion::same((string) $this->message, $this->expectedMessage);
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeLessThan(100);
            $this->message = new FailedMessage();

            $this->expectedMessage  = "Expected 100 not to be less than 100\n\n";
            $this->expectedMessage .= "    expected not: < 100\n";
            $this->expectedMessage .= "             got:   100";
        });
        it('report failed message', function () {
            $this->matcher->match(100);
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, $this->expectedMessage);
        });
    });

});
