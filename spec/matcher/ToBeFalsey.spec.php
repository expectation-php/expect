<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeFalsey;

describe('ToBeFalsey', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeFalsey();
        });
        context('when match', function () {
            context('when actual is false', function () {
                it('return true', function () {
                    Assertion::true($this->matcher->match(false));
                });
            });
            context('when actual is null', function () {
                it('return true', function () {
                    Assertion::true($this->matcher->match(null));
                });
            });
        });
        context('when unmatch', function () {
            context('when actual is true', function () {
                it('return false', function () {
                    Assertion::false($this->matcher->match(true));
                });
            });
            context('when actual is blank', function () {
                it('return false', function () {
                    Assertion::false($this->matcher->match(''));
                });
            });
            context('when actual is 0', function () {
                it('return false', function () {
                    Assertion::false($this->matcher->match(0));
                });
            });
        });
    });
    describe('#reportFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeFalsey();
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match(true);
            $this->matcher->reportFailed($this->message);
            Assertion::same((string) $this->message, "Expected falsey value, got true");
        });
    });
    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeFalsey();
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match(false);
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, "Expected truthy value, got false");
        });
    });
});
