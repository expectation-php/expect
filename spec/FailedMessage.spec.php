<?php

use expect\FailedMessage;
use Assert\Assertion;


describe('FailedMessage', function() {

    describe('#appendText', function() {
        beforeEach(function() {
            $this->message = new FailedMessage();
        });
        it('append text', function() {
            $this->message->appendText('expected');
            Assertion::same((string) $this->message, "\nexpected");
        });
        it('return expect\FailedMessage instance', function() {
            $result = $this->message->appendText('expected');
            Assertion::isInstanceOf($result, 'expect\FailedMessage');
        });
    });

    describe('#appendValue', function() {
        beforeEach(function() {
            $this->message = new FailedMessage();
        });
        it('return expect\FailedMessage instance', function() {
            $result = $this->message->appendValue("expected");
            Assertion::isInstanceOf($result, 'expect\FailedMessage');
        });
        context('when integer value', function() {
            it('append string', function() {
                $result = $this->message->appendValue(100);
                Assertion::same((string) $result, "\n100");
            });
        });
        context('when string value', function() {
            it('append string with quote', function() {
                $result = $this->message->appendValue('foo');
                Assertion::same((string) $result, "\n'foo'");
            });
        });
        context('when bool value', function() {
            context('when true', function() {
                it('append true text', function() {
                    $result = $this->message->appendValue(true);
                    Assertion::same((string) $result, "\ntrue");
                });
            });
            context('when false', function() {
                it('append false text', function() {
                    $result = $this->message->appendValue(false);
                    Assertion::same((string) $result, "\nfalse");
                });
            });
        });
        context('when null value', function() {
            it('append null text', function() {
                $result = $this->message->appendValue(null);
                Assertion::same((string) $result, "\nnull");
            });
        });
    });

    describe('#__toString', function() {
        beforeEach(function() {
            $this->message = new FailedMessage();
        });
        it('return message string', function () {
            $this->message->appendText('message');
            Assertion::same($this->message->__toString(), "\nmessage");
        });
    });

});
