<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToHaveKey;

describe('ToHaveKey', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToHaveKey('foo');
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match([ 'foo' => 1 ]);
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match([ 'bar' => 1 ]);
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToHaveKey('foo');
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match([ 'bar' => 1 ]);
            $this->matcher->reportFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected array to have the key 'foo'\n");
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToHaveKey('foo');
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match([ 'foo' => 1 ]);
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected array not to have the key 'foo'\n");
        });
    });
});
