<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToThrow;

describe('ToThrow', function () {
    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToThrow(RuntimeException::class);
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match(function () {
                    throw new RuntimeException();
                });
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(function () {
                });
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToThrow(RuntimeException::class);
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match(function () {});
            $this->matcher->reportFailed($this->message);

            $message = $this->loadFixture('text:toThrow:failedMessage');
            Assertion::same((string) $this->message, $message);
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToThrow(RuntimeException::class);
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match(function () {});
            $this->matcher->reportNegativeFailed($this->message);

            $message = $this->loadFixture('text:toThrow:negativeFailedMessage');
            Assertion::same((string) $this->message, $message);
        });
    });

});
