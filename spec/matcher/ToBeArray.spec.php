<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\matcher\ToBeArray;

describe(ToBeArray::class, function () {

    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new ToBeArray();
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match([]);
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match(null);
                Assertion::false($result);
            });
        });
    });

});
