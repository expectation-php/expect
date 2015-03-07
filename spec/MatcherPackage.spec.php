<?php

use expect\MatcherPackage;
use Assert\Assertion;
use Prophecy\Prophet;
use Prophecy\Argument;


describe('MatcherPackage', function() {

    describe('#registerTo', function() {
        beforeEach(function() {
            $this->prophet = new Prophet();

            $registry = $this->prophet->prophesize('expect\MatcherRegistry');
            $registry->register(Argument::type('expect\package\MatcherClass'))
                ->shouldBeCalledTimes(1); //ToEql only

            $this->registry = $registry->reveal();
            $this->package = new MatcherPackage('expect\fixture\matcher', __DIR__ . '/fixtures/matcher');
        });
        it('package register', function() {
            $this->package->registerTo($this->registry);
            $this->prophet->checkPredictions();
        });
    });

});
