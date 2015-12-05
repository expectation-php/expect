<?php

use Assert\Assertion;
use expect\package\DefaultPackageRegistrar;
use expect\MatcherRegistry;
use expect\package\MatcherClass;
use Prophecy\Argument;
use Prophecy\Prophet;

describe(DefaultPackageRegistrar::class, function () {
    beforeEach(function () {
        $this->prophet = new Prophet();

        $registry = $this->prophet->prophesize(MatcherRegistry::class);
        $registry->register(Argument::type(MatcherClass::class))
            ->shouldBeCalled();

        $this->registry = $registry->reveal();

        $this->registrar = new DefaultPackageRegistrar();
    });
    it('register package', function () {
        $this->registrar->registerTo($this->registry);
        $this->prophet->checkPredictions();
    });
});
