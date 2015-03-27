<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeBelow;

describe('ToBeBelow', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeBelow(100);
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match(99);
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
