<?php

use Assert\Assertion;
use expect\package\ReflectionIterator;

describe('ReflectionIterator', function () {
    beforeEach(function () {
        $this->path = realpath(__DIR__ . '/../fixtures/matcher/ToEql.php');
        $this->iterator = new ReflectionIterator('expect\\fixture\\matcher', __DIR__ . '/../fixtures/matcher');
    });
    describe('#current', function () {
        beforeEach(function () {
            $this->reflection = $this->iterator->current();
        });
        it('return current matcher class', function () {
            Assertion::isInstanceOf($this->reflection, '\ReflectionClass');
            Assertion::same($this->reflection->getName(), 'expect\fixture\matcher\ToEql');
        });
    });
    describe('#key', function () {
        it('return current key', function () {
            Assertion::same($this->iterator->key(), $this->path);
        });
    });
    describe('#next', function () {
        it('move next matcher class', function () {
            $this->iterator->next();
            $this->iterator->next();
            Assertion::false($this->iterator->valid());
        });
    });
    describe('#rewind', function () {
        it('move first　matcher class', function () {
            $this->iterator->next();
            $this->iterator->next();
            $this->iterator->rewind();
            Assertion::true($this->iterator->valid());
        });
    });
});
