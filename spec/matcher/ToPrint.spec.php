<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToPrint;

describe('ToPrint', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToPrint('foo');
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match(function () {
                    echo 'foo';
                });
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(function () {
                    echo 'bar';
                });
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToPrint('foo');
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match(function () {
                echo 'bar';
            });
            $this->matcher->reportFailed($this->message);
            $message = $this->loadFixture('text:toPrint:failedMessage');

            Assertion::same((string) $this->message, $message);
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToPrint('foo');
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match(function () {
                echo 'foo';
            });
            $this->matcher->reportNegativeFailed($this->message);
            $message = $this->loadFixture('text:toPrint:negativeFailedMessage');

            Assertion::same((string) $this->message, $message);
        });
    });

});
