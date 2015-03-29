<?php

use Assert\Assertion;
use expect\package\DefaultPackageRegistrar;
use Prophecy\Argument;
use Prophecy\Prophet;


describe('DefaultPackageRegistrar', function () {
    beforeEach(function () {
        $this->prophet = new Prophet();

        $registry = $this->prophet->prophesize('expect\MatcherRegistry');
        $registry->register(Argument::type('expect\package\MatcherClass'))
            ->shouldBeCalled();

        $this->registry = $registry->reveal();

        $this->registrar = new DefaultPackageRegistrar();
    });
    it('register package', function () {
        $this->registrar->registerTo($this->registry);
        $this->prophet->checkPredictions();
    });
});
