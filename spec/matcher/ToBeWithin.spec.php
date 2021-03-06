<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeWithin;

describe(ToBeWithin::class, function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeWithin([10, 20]);
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match(11);
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(21);
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeWithin([10, 20]);
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match(9);
            $this->matcher->reportFailed($this->message);

            $message = $this->loadFixture('text:toBeWithin:failedMessage');
            Assertion::same((string) $this->message, $message);
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeWithin([10, 20]);
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match(10);
            $this->matcher->reportNegativeFailed($this->message);

            $message = $this->loadFixture('text:toBeWithin:negativeFailedMessage');
            Assertion::same((string) $this->message, $message);
        });
    });

});
