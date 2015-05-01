<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeFalse;

describe(ToBeFalse::class, function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeFalse();
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match(false);
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(true);
                Assertion::false($result);
            });
        });
    });

});
