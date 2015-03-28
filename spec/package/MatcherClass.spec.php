<?php

use Assert\Assertion;
use expect\package\MatcherClass;

describe('MatcherClass', function () {
    beforeEach(function () {
        $this->matcherClass = new MatcherClass('expect\\matcher', 'ToEqual');
    });
    describe('#getName', function () {
        it('return the name of the class that contains the name space', function () {
            Assertion::same($this->matcherClass->getName(), 'expect\\matcher\\ToEqual');
        });
    });
    describe('#getClassName', function () {
        it('return the class name without the namespace', function () {
            Assertion::same($this->matcherClass->getClassName(), 'ToEqual');
        });
    });
});
