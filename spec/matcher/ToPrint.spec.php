<?php

use expect\matcher\ToPrint;
use expect\FailedMessage;
use Assert\Assertion;


describe('ToPrint', function() {

    describe('#match', function() {
        beforeEach(function() {
            $this->matcher = new ToPrint('foo');
        });
        context('when match', function() {
            it('return true', function() {
                $result = $this->matcher->match(function() {
                    echo 'foo';
                });
                Assertion::true($result);
            });
        });
        context('when unmatch', function() {
            it('return false', function() {
                $result = $this->matcher->match(function() {
                    echo 'bar';
                });
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function() {
        beforeEach(function() {
            $this->matcher = new ToPrint('foo');
            $this->message = new FailedMessage();
        });
        it('report failed message', function() {
            $this->matcher->match(function() {
                echo 'bar';
            });
            $this->matcher->reportFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected 'foo', got 'bar'\n");
        });
    });

    describe('#reportNegativeFailed', function() {
        beforeEach(function() {
            $this->matcher = new ToPrint('foo');
            $this->message = new FailedMessage();
        });
        it('report failed message', function() {
            $this->matcher->match(function() {
                echo 'foo';
            });
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected output other than 'foo'\n");
        });
    });

});
