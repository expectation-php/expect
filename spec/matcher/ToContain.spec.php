<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToContain;

describe(ToContain::class, function () {

    describe('#match', function () {
        context('when string', function () {
            beforeEach(function () {
                $this->matcher = new ToContain([ 'foo', 'bar' ]);
            });
            context('when match', function () {
                it('return true', function () {
                    $result = $this->matcher->match('foo bar');
                    Assertion::true($result);
                });
            });
            context('when unmatch', function () {
                it('return false', function () {
                    $result = $this->matcher->match('foo1');
                    Assertion::false($result);
                });
            });
        });
        context('when array', function () {
            beforeEach(function () {
                $this->matcher = new ToContain([ 'foo', 'bar' ]);
            });
            context('when match', function () {
                it('return true', function () {
                    $result = $this->matcher->match([ 'foo', 'bar' ]);
                    Assertion::true($result);
                });
            });
            context('when unmatch', function () {
                it('return false', function () {
                    $result = $this->matcher->match([ 'foo1' ]);
                    Assertion::false($result);
                });
            });
        });
    });

    describe('#reportFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToContain([ 'foo', 'bar' ]);
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match(['bar']);
            $this->matcher->reportFailed($this->message);

            $message = $this->loadFixture('text:toContain:failedMessage');
            Assertion::same((string) $this->message, $message);
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToContain([ 'foo', 'bar' ]);
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match('foo bar');
            $this->matcher->reportNegativeFailed($this->message);

            $message = $this->loadFixture('text:toContain:negativeFailedMessage');
            Assertion::same((string) $this->message, $message);
        });
    });

});
