<?php

use expect\matcher\ToHaveLength;
use expect\FailedMessage;
use Assert\Assertion;
use ArrayIterator;


describe('ToHaveLength', function() {

    describe('#match', function() {
        beforeEach(function() {
            $this->matcher = new ToHaveLength(3);
        });
        context('when match', function() {
            context('when string', function() {
                it('return true', function() {
                    $result = $this->matcher->match("foo");
                    Assertion::true($result);
                });
            });
            context('when array', function() {
                it('return true', function() {
                    $result = $this->matcher->match([1, 2, 3]);
                    Assertion::true($result);
                });
            });
            context('when countable', function() {
                it('return true', function() {
                    $result = $this->matcher->match(new ArrayIterator([1, 2, 3]));
                    Assertion::true($result);
                });
            });
        });
        context('when unmatch', function() {
            it('return false', function() {
                $result = $this->matcher->match("foobar");
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function() {
        beforeEach(function() {
            $this->matcher = new ToHaveLength(4);
            $this->message = new FailedMessage();
        });
        it('report failed message', function() {
            $this->matcher->match("foo");
            $this->matcher->reportFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected string to have a length of 4\n");
        });
    });

    describe('#reportNegativeFailed', function() {
        beforeEach(function() {
            $this->matcher = new ToHaveLength(3);
            $this->message = new FailedMessage();
        });
        it('report failed message', function() {
            $this->matcher->match("foo");
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, "\nexpected string not to have a length of 3\n");
        });
    });

});
