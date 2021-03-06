<?php

use Assert\Assertion;
use expect\matcher\TruthyMatcher;

describe(TruthyMatcher::class, function () {
    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new TruthyMatcher();
        });
        context('when match', function () {
            context('when actual is true', function () {
                it('return true', function () {
                    $result = $this->matcher->match(true);
                    Assertion::true($result);
                });
            });
            context('when actual is blank', function () {
                it('return true', function () {
                    Assertion::true($this->matcher->match(''));
                });
            });
            context('when actual is 0', function () {
                it('return true', function () {
                    Assertion::true($this->matcher->match(0));
                });
            });
        });
        context('when unmatch', function () {
            context('when actual is false', function () {
                it('return false', function () {
                    $result = $this->matcher->match(false);
                    Assertion::false($result);
                });
            });
            context('when actual is null', function () {
                it('return false', function () {
                    Assertion::false($this->matcher->match(null));
                });
            });
        });
    });

});
