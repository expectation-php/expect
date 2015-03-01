<?php

use expect\matcher\ToEqual;
use expect\FailedMessage;
use Assert\Assertion;


describe('ToEqual', function() {

    describe('#match', function() {
        beforeEach(function() {
            $this->matcher = new ToEqual(true);
        });
        context('when match', function() {
            it('return true', function() {
                $result = $this->matcher->match(true);
                Assertion::true($result);
            });
        });
        context('when unmatch', function() {
            it('return false', function() {
                $result = $this->matcher->match(false);
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function() {
        beforeEach(function() {
            $this->matcher = new ToEqual(true);
            $this->message = new FailedMessage();
        });
        it('report failed message', function() {
            $this->matcher->match(false);
            $this->matcher->reportFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected true\n     got false\n");
        });
    });

    describe('#reportNegativeFailed', function() {
        beforeEach(function() {
            $this->matcher = new ToEqual(true);
            $this->message = new FailedMessage();
        });
        it('report failed message', function() {
            $this->matcher->match(true);
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected not true\n         got true\n");
        });
    });
});
