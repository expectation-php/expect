<?php

use \stdClass;
use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeAnInstanceOf;

describe('ToBeAnInstanceOf', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeAnInstanceOf("expect\Matcher");
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match($this->matcher);
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(new stdClass());
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeAnInstanceOf("expect\Matcher");
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match(new stdClass());
            $this->matcher->reportFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected stdClass to be an instance of expect\Matcher\n");
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeAnInstanceOf("expect\Matcher");
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match($this->matcher);
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected expect\matcher\ToBeAnInstanceOf not to be an instance of expect\Matcher\n");
        });
    });

});
