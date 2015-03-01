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
            Assertion::same((string) $this->message, 'expected');
        });
        it('return expect\FailedMessage instance', function() {
            $result = $this->message->appendText('expected');
            Assertion::isInstanceOf($result, 'expect\FailedMessage');
        });
    });

    xdescribe('#appendValue', function() {
        xit('return expect\FailedMessage instance');

        xcontext('when string value', function() {
            xit('append string with quote');
        });
        xcontext('when bool value', function() {
            xcontext('when true', function() {
                xit('append true text');
            });
            xcontext('when false', function() {
                xit('append false text');
            });
        });
        xcontext('when null value', function() {
            xit('append null text');
        });
    });

    xdescribe('#__toString', function() {
        xit('return message string');
    });

});
