<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToEqual;

describe('ToEqual', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToEqual(true);
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match(true);
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(false);
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToEqual(true);
            $this->message = new FailedMessage();
            $this->expectedMessage  = "\nExpected false to be true\n\n";
            $this->expectedMessage .= "    expected: true\n";
            $this->expectedMessage .= "         got: false\n";
        });
        it('report failed message', function () {
            $this->matcher->match(false);
            $this->matcher->reportFailed($this->message);
            Assertion::same((string) $this->message, $this->expectedMessage);
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToEqual(true);
            $this->message = new FailedMessage();
            $this->expectedMessage  = "\nExpected true not to be true\n\n";
            $this->expectedMessage .= "    expected not: true\n";
            $this->expectedMessage .= "             got: true\n";
        });
        it('report failed message', function () {
            $this->matcher->match(true);
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, $this->expectedMessage);
        });
    });
});
