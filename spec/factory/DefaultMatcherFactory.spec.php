<?php

use Assert\Assertion;
use expect\factory\DefaultMatcherFactory;
use expect\MatcherDictionary;
use expect\package\MatcherClass;

describe('DefaultMatcherFactory', function () {

    describe('#create', function () {
        beforeEach(function () {
            $dictionary = new MatcherDictionary([
                'ToBeTrue' => new MatcherClass('expect\matcher', 'ToBeTrue'),
                'ToEqual'  => new MatcherClass('expect\matcher', 'ToEqual')
            ]);
            $this->factory = new DefaultMatcherFactory($dictionary);
        });
        context('when no arguments', function () {
            beforeEach(function () {
                $this->matcher = $this->factory->create('ToBeTrue', []);
            });
            it('return matcher instance', function () {
                Assertion::isInstanceOf($this->matcher, 'expect\matcher\ToBeTrue');
            });
        });
        context('when there are arguments', function () {
            beforeEach(function () {
                $this->matcher = $this->factory->create('ToEqual', [ 'foo' ]);
            });
            it('return matcher instance', function () {
                Assertion::isInstanceOf($this->matcher, 'expect\matcher\ToEqual');
            });
        });
    });

});
