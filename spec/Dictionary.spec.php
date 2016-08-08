<?php

use Assert\Assertion;
use expect\Dictionary;

describe(Dictionary::class, function () {
    beforeEach(function () {
        $this->dict = Dictionary::fromArray([
            'foo' => 1
        ]);
    });
    describe('#count', function () {
        it('return item count', function () {
            $value = $this->dict->count();
            Assertion::same($value, 1);
        });
    });
    describe('#containsKey', function () {
        context('when have key', function () {
            it('return true', function () {
                $value = $this->dict->containsKey('foo');
                Assertion::true($value);
            });
        });
        context('when have not key', function () {
            it('return false', function () {
                $value = $this->dict->containsKey('bar');
                Assertion::false($value);
            });
        });
    });
});
