<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToMatch;

describe(ToMatch::class, function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToMatch('/foo/');
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match('foo');
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match('bar');
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToMatch('/foo/');
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match('bar');
            $this->matcher->reportFailed($this->message);

            $message = $this->loadFixture('text:toMatch:failedMessage');
            Assertion::same((string) $this->message, $message);
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToMatch('/foo/');
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match('foo');
            $this->matcher->reportNegativeFailed($this->message);

            $message = $this->loadFixture('text:toMatch:negativeFailedMessage');
            Assertion::same((string) $this->message, $message);
        });
    });

});
