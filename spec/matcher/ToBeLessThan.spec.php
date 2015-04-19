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

            $message = $this->loadFixture('text:toBeLessThan:failedMessage');
            Assertion::same((string) $this->message, $message);
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeLessThan(100);
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match(100);
            $this->matcher->reportNegativeFailed($this->message);

            $message = $this->loadFixture('text:toBeLessThan:negativeFailedMessage');
            Assertion::same((string) $this->message, $message);
        });
    });

});
