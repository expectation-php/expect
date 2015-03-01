<?php

use expect\matcher\ToBeFalse;
use expect\FailedMessage;
use Assert\Assertion;


describe('ToBeFalse', function() {

    describe('#match', function() {
        beforeEach(function() {
            $this->matcher = new ToBeFalse();
        });
        context('when match', function() {
            it('return true', function() {
                $result = $this->matcher->match(false);
                Assertion::true($result);
            });
        });
        context('when unmatch', function() {
            it('return false', function() {
                $result = $this->matcher->match(true);
                Assertion::false($result);
            });
        });
    });

});
