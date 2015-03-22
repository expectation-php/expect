<?php

use expect\matcher\ToThrow;
use expect\FailedMessage;
use Assert\Assertion;
use \RuntimeException;


describe('ToThrow', function() {
    describe('#match', function() {
        beforeEach(function() {
            $this->matcher = new ToThrow('\RuntimeException');
        });
        context('when match', function() {
            it('return true', function() {
                $result = $this->matcher->match(function() {
                    throw new RuntimeException();
                });
                Assertion::true($result);
            });
        });
        context('when unmatch', function() {
            it('return false', function() {
                $result = $this->matcher->match(function() {
                });
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function() {
        beforeEach(function() {
            $this->matcher = new ToThrow('\RuntimeException');
            $this->message = new FailedMessage();
        });
        it('report failed message', function() {
            $this->matcher->match(function() {
            });
            $this->matcher->reportFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected \RuntimeException to be thrown, none thrown\n");
        });
    });

    describe('#reportNegativeFailed', function() {
        beforeEach(function() {
            $this->matcher = new ToThrow('\RuntimeException');
            $this->message = new FailedMessage();
        });
        it('report failed message', function() {
            $this->matcher->match(function() {
            });
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected \RuntimeException not to be thrown\n");
        });
    });

});