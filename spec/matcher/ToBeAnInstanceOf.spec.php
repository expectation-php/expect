<?php

use \stdClass;
use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeAnInstanceOf;

describe('ToBeAnInstanceOf', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeAnInstanceOf("expect\Matcher");
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match($this->matcher);
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(new stdClass());
                Assertion::false($result);
            });
        });
    });

    describe('#reportFailed', function () {
        context('when actual value is class name', function () {
            beforeEach(function () {
                $this->matcher = new ToBeAnInstanceOf("expect\Matcher");
                $this->message = new FailedMessage();
            });
            it('report failed message', function () {
                $this->matcher->match(new stdClass());
                $this->matcher->reportFailed($this->message);

                $message = $this->loadFixture('text:toBeAnInstanceOf:failedMessage');
                Assertion::same((string) $this->message, $message);
            });
        });
        context('when actual value is null', function () {
            beforeEach(function () {
                $this->matcher = new ToBeAnInstanceOf("expect\Matcher");
                $this->message = new FailedMessage();
            });
            it('report failed message', function () {
                $this->matcher->match(null);
                $this->matcher->reportFailed($this->message);

                $message = $this->loadFixture('text:toBeAnInstanceOf:null:failedMessage');
                Assertion::same((string) $this->message, $message);
            });
        });
    });

    describe('#reportNegativeFailed', function () {
        beforeEach(function () {
            $this->matcher = new ToBeAnInstanceOf("expect\matcher\ToBeAnInstanceOf");
            $this->message = new FailedMessage();
        });
        it('report failed message', function () {
            $this->matcher->match($this->matcher);
            $this->matcher->reportNegativeFailed($this->message);

            $message = $this->loadFixture('text:toBeAnInstanceOf:negativeFailedMessage');
            Assertion::same((string) $this->message, $message);
        });
    });

});
