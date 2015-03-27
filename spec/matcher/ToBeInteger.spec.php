<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeInteger;

describe('ToBeInteger', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeInteger();
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match(1);
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
