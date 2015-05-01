<?php

use Assert\Assertion;
use expect\package\DefaultMatcherPackage;
use expect\MatcherRegistry;
use expect\package\MatcherClass;
use Prophecy\Argument;
use Prophecy\Prophet;

describe(DefaultMatcherPackage::class, function () {
    beforeEach(function () {
        $this->prophet = new Prophet();

        $registry = $this->prophet->prophesize(MatcherRegistry::class);
        $registry->register(Argument::type(MatcherClass::class))
            ->shouldBeCalled();

        $this->registry = $registry->reveal();
        $this->package = new DefaultMatcherPackage();
    });
    it('register package', function () {
        $this->package->registerTo($this->registry);
        $this->prophet->checkPredictions();
    });
});
