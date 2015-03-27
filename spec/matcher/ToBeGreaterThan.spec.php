<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeGreaterThan;

describe('ToBeGreaterThan', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeGreaterThan(100);
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match(100);
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(99);
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function () {
        context('when actual length < expected length', function () {
            beforeEach(function () {
                $this->matcher = new ToBeGreaterThan(100);
                $this->message = new FailedMessage();
            });
            it('report failed message', function () {
                $this->matcher->match(99);
                $this->matcher->reportFailed($this->message);
                Assertion::same((string) $this->message, "\nexpected 99 to be greater than 100\nexpected: >= 100\n     got:     99\n");
            });
        });
        context('when actual length == expected length', function () {
            beforeEach(function () {
                $this->matcher = new ToBeGreaterThan(99);
                $this->message = new FailedMessage();
            });
            it('report failed message', function () {
                $this->matcher->match(98);
                $this->matcher->reportFailed($this->message);
                Assertion::same((string) $this->message, "\nexpected 98 to be greater than 99\nexpected: >= 99\n     got:    98\n");
            });
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeGreaterThan(100);
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match(100);
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected 100 not to be greater than 100\n");
        });
    });

});
