<?php

use \ArrayIterator;
use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToHaveLength;

describe('ToHaveLength', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToHaveLength(3);
        });
        context('when match', function () {
            context('when string', function () {
                it('return true', function () {
                    $result = $this->matcher->match("foo");
                    Assertion::true($result);
                });
            });
            context('when array', function () {
                it('return true', function () {
                    $result = $this->matcher->match([1, 2, 3]);
                    Assertion::true($result);
                });
            });
            context('when countable', function () {
                it('return true', function () {
                    $result = $this->matcher->match(new ArrayIterator([1, 2, 3]));
                    Assertion::true($result);
                });
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match("foobar");
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToHaveLength(4);
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match("foo");
            $this->matcher->reportFailed($this->message);

            $this->expectedMessage  = "Expected string to have a length of 4\n\n";
            $this->expectedMessage .= "    expected: 4\n";
            $this->expectedMessage .= "      length: 3";

            Assertion::same((string) $this->message, $this->expectedMessage);
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToHaveLength(3);
            $this->message = new FailedMessage();

            $this->expectedMessage  = "Expected string not to have a length of 3\n\n";
            $this->expectedMessage .= "    expected not: 3\n";
            $this->expectedMessage .= "          length: 3";
        });
        it('report failed message', function () {
            $this->matcher->match("foo");
            $this->matcher->reportNegativeFailed($this->message);
            Assertion::same((string) $this->message, $this->expectedMessage);
        });
    });

});
