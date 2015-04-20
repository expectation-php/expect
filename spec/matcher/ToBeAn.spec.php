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
        });
        it('report failed message', function () {
            $this->matcher->match(1);
            $this->matcher->reportFailed($this->message);

            $message = $this->loadFixture('text:toBeAn:failedMessage');
            Assertion::same((string) $this->message, $message);
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeAn("string");
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match("foo");
            $this->matcher->reportNegativeFailed($this->message);

            $message = $this->loadFixture('text:toBeAn:negativeFailedMessage');
            Assertion::same((string) $this->message, $message);
        });
    });

});
