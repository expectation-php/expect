<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeString;

describe('ToBeString', function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeString();
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match("foo");
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
