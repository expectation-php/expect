<?php

use expect\package\MatcherClass;
use Assert\Assertion;


describe('MatcherClass', function() {
    beforeEach(function() {
        $this->matcherClass = new MatcherClass('expect\\matcher', 'ToEqual');
    });
    describe('#getName', function() {
        it('return matcher class name', function() {
            Assertion::same($this->matcherClass->getName(), 'expect\\matcher\\ToEqual');
        });
    });
});
