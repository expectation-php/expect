<?php

use expect\matcher\ToBeString;
use expect\FailedMessage;
use Assert\Assertion;


describe('ToBeString', function() {

    describe('#match', function() {
        beforeEach(function() {
            $this->matcher = new ToBeString();
        });
        context('when match', function() {
            it('return true', function() {
                $result = $this->matcher->match("foo");
                Assertion::true($result);
            });
        });
        context('when unmatch', function() {
            it('return false', function() {
                $result = $this->matcher->match(1);
                Assertion::false($result);
            });
        });
    });

});