<?php

use Assert\Assertion;
use expect\matcher\PatternMatcher;

describe(PatternMatcher::class, function () {
    describe('#match', function () {
        beforeEach(function () {
            $this->matcher = new PatternMatcher('/foo/');
        });
        context('when match', function () {
            it('return true', function () {
                $result = $this->matcher->match('foo');
                Assertion::true($result);
            });
        });
        context('when unmatch', function () {
            it('return false', function () {
                $result = $this->matcher->match('bar');
                Assertion::false($result);
            });
        });
    });
});
