<?php

use Assert\Assertion;
use expect\FailedMessage;

describe(FailedMessage::class, function () {

    describe('#appendText', function () {
        beforeEach(function () {
            $this->message = new FailedMessage();
        });
        it('append text', function () {
            $this->message->appendText('expected');
            Assertion::same((string) $this->message, "expected");
        });
        it('return expect\FailedMessage instance', function () {
            $result = $this->message->appendText('expected');
            Assertion::isInstanceOf($result, FailedMessage::class);
        });
    });

    describe('#appendValue', function () {
        beforeEach(function () {
            $this->message = new FailedMessage();
        });
        it('return expect\FailedMessage instance', function () {
            $result = $this->message->appendValue("expected");
            Assertion::isInstanceOf($result, FailedMessage::class);
        });
        context('when integer value', function () {
            it('append string', function () {
                $result = $this->message->appendValue(100);
                Assertion::same((string) $result, "100");
            });
        });
        context('when string value', function () {
            it('append string with quote', function () {
                $result = $this->message->appendValue('foo');
                Assertion::same((string) $result, "'foo'");
            });
        });
        context('when bool value', function () {
            context('when true', function () {
                it('append true text', function () {
                    $result = $this->message->appendValue(true);
                    Assertion::same((string) $result, "true");
                });
            });
            context('when false', function () {
                it('append false text', function () {
                    $result = $this->message->appendValue(false);
                    Assertion::same((string) $result, "false");
                });
            });
        });
        context('when null value', function () {
            it('append null text', function () {
                $result = $this->message->appendValue(null);
                Assertion::same((string) $result, "null");
            });
        });
    });

    describe('#concat', function () {
        beforeEach(function () {
            $this->leadMessage = FailedMessage::fromString('Expect:');
            $this->resultMessage = FailedMessage::fromString('concat message');
        });
        it('concat message', function () {
            $message = $this->leadMessage->concat($this->resultMessage);
            Assertion::same((string) $message, "Expect:\nconcat message");
        });
    });

    describe('#__toString', function () {
        beforeEach(function () {
            $this->message = new FailedMessage();
        });
        it('return message string', function () {
            $this->message->appendText('message');
            Assertion::same($this->message->__toString(), "message");
        });
    });

});
