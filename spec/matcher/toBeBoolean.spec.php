<?php

use expect\matcher\ToBeBoolean;
use expect\FailedMessage;
use Assert\Assertion;


describe('ToBeBoolean', function() {

    describe('#match', function() {
        beforeEach(function() {
            $this->matcher = new ToBeBoolean();
        });
        context('when match', function() {
            it('return true', function() {
                $result = $this->matcher->match(true);
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
