<?php

use expect\matcher\ToBeA;
use expect\FailedMessage;
use Assert\Assertion;


describe('ToBeA', function() {

    describe('#match', function() {
        beforeEach(function() {
            $this->matcher = new ToBeA("string");
        });
        context('when match', function() {
            it('return true', function() {
                $result = $this->matcher->match("foo");
                Assertion::true($result);
            });
        });
        context('when unmatch', function() {
            it('return false', function() {
                $result = $this->matcher->match(11);
                Assertion::false($result);
            });
        });
    });

});
