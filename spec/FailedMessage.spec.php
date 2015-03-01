<?php

xdescribe('FailedMessage', function() {

    xdescribe('#appendText', function() {
        xit('append text');
        xit('return expect\FailedMessage instance');
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
