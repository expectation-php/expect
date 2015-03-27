<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeTrue;

describe('ToBeTrue', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeTrue();
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match(true);
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(false);
                Assertion::false($result);
            });
        });
    });

});
