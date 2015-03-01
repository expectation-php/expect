<?php

use expect\matcher\ToBeTrue;
use expect\FailedMessage;
use Assert\Assertion;


describe('ToBeTrue', function() {

    describe('#match', function() {
        beforeEach(function() {
            $this->matcher = new ToBeTrue();
        });
        context('when match', function() {
            it('return true', function() {
                $result = $this->matcher->match(true);
                Assertion::true($result);
            });
        });
        context('when unmatch', function() {
            it('return false', function() {
                $result = $this->matcher->match(false);
                Assertion::false($result);
            });
        });
    });

});
