<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeFloat;

describe(ToBeFloat::class, function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeFloat();
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match(1.1);
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(11);
                Assertion::false($result);
            });
        });
    });

});
