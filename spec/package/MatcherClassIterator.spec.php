<?php

use expect\package\MatcherClassIterator;
use Assert\Assertion;


describe('MatcherClassIterator', function() {
    beforeEach(function() {
        $this->path = realpath(__DIR__ . '/../fixtures/matcher/ToEql.php');
        $this->iterator = new MatcherClassIterator('expect\\matcher\\fixture', __DIR__ . '/../fixtures/matcher');
    });
    describe('#current', function() {
        beforeEach(function() {
            $this->matcherClass = $this->iterator->current();
        });
        it('return current matcher class', function() {
            Assertion::isInstanceOf($this->matcherClass, 'expect\package\MatcherClass');
            Assertion::same($this->matcherClass->getName(), 'expect\matcher\fixture\ToEql');
            Assertion::same($this->matcherClass->getClassName(), 'ToEql');
        });
    });
    describe('#key', function() {
        it('return current key', function() {
            Assertion::same($this->iterator->key(), $this->path);
        });
    });
    describe('#next', function() {
        it('move next matcher class', function() {
            $this->iterator->next();
            $this->iterator->next();
            Assertion::false($this->iterator->valid());
        });
    });
    describe('#rewind', function() {
        it('move first　matcher class', function() {
            $this->iterator->next();
            $this->iterator->next();
            $this->iterator->rewind();
            Assertion::true($this->iterator->valid());
        });
    });
});
