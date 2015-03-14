<?php

use expect\package\DefaultMatcherPackage;
use Prophecy\Prophet;
use Prophecy\Argument;
use Assert\Assertion;


describe('DefaultMatcherPackage', function() {
    beforeEach(function() {
        $this->prophet = new Prophet();

        $registry = $this->prophet->prophesize('expect\MatcherRegistry');
        $registry->register(Argument::type('expect\package\MatcherClass'))
            ->shouldBeCalled();

        $this->registry = $registry->reveal();
        $this->package = new DefaultMatcherPackage();
    });
    it('register package', function() {
        $this->package->registerTo($this->registry);
        $this->prophet->checkPredictions();
    });
});
