<?php

use Assert\Assertion;
use expect\matcher\ToBe;

describe(ToBe::class, function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBe(100);
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match(100);
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(1);
                Assertion::false($result);
            });
        });
    });

});
