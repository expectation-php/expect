<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeA;

describe('ToBeA', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeA("string");
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match("foo");
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
