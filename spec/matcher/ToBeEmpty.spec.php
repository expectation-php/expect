<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeEmpty;

describe(ToBeEmpty::class, function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeEmpty();
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match("");
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match("foo");
                Assertion::false($result);
            });
        });
    });

});
