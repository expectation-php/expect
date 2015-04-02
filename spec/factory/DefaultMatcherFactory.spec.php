<?php

use Assert\Assertion;
use expect\factory\DefaultMatcherFactory;
use expect\MatcherDictionary;
use expect\package\MatcherClass;

describe('DefaultMatcherFactory', function () {

    describe('#create', function () {
        beforeEach(function () {
            $dictionary = new MatcherDictionary([
                'toBeTrue' => new MatcherClass('expect\matcher', 'ToBeTrue'),
                'toEqual'  => new MatcherClass('expect\matcher', 'ToEqual')
            ]);
            $this->factory = new DefaultMatcherFactory($dictionary);
        });
        context('when no arguments', function () {
            beforeEach(function () {
                $this->matcher = $this->factory->create('toBeTrue', []);
            });
            it('return matcher instance', function () {
                Assertion::isInstanceOf($this->matcher, 'expect\matcher\ToBeTrue');
            });
        });
        context('when there are arguments', function () {
            beforeEach(function () {
                $this->matcher = $this->factory->create('toEqual', [ 'foo' ]);
            });
            it('return matcher instance', function () {
                Assertion::isInstanceOf($this->matcher, 'expect\matcher\ToEqual');
            });
        });
    });

});
