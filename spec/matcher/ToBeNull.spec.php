<?php

use Assert\Assertion;
use expect\matcher\ToBeNull;

describe('ToBeNull', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeNull();
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match(null);
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(100);
                Assertion::false($result);
            });
        });
    });

});
