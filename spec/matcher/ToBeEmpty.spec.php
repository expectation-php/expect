<?php

use expect\matcher\ToBeEmpty;
use expect\FailedMessage;
use Assert\Assertion;


describe('ToBeEmpty', function() {

    describe('#match', function() {
        beforeEach(function() {
            $this->matcher = new ToBeEmpty();
        });
        context('when match', function() {
            it('return true', function() {
                $result = $this->matcher->match("");
                Assertion::true($result);
            });
        });
        context('when unmatch', function() {
            it('return false', function() {
                $result = $this->matcher->match("foo");
                Assertion::false($result);
            });
        });
    });

});
