<?php

use expect\DefaultMatcherFactory;
use Assert\Assertion;


describe('DefaultMatcherFactory', function() {

    describe('#create', function() {
        beforeEach(function() {
            $this->factory = new DefaultMatcherFactory([
                'ToBeTrue' => 'expect\matcher\ToBeTrue',
                'ToEqual' => 'expect\matcher\ToEqual'
            ]);
        });
        context('when no arguments', function() {
            beforeEach(function() {
                $this->matcher = $this->factory->create('ToBeTrue', []);
            });
            it('return matcher instance', function() {
                Assertion::isInstanceOf($this->matcher, 'expect\matcher\ToBeTrue');
            });
        });
        context('when there are arguments', function() {
            beforeEach(function() {
                $this->matcher = $this->factory->create('ToEqual', [ 'foo' ]);
            });
            it('return matcher instance', function() {
                Assertion::isInstanceOf($this->matcher, 'expect\matcher\ToEqual');
            });
        });
    });

});
