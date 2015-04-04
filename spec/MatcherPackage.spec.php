<?php

use Assert\Assertion;
use expect\MatcherPackage;
use expect\package\ComposerJsonNotFoundException;
use Prophecy\Argument;
use Prophecy\Prophet;

describe('MatcherPackage', function () {
    describe('#registerTo', function () {
        beforeEach(function () {
            $this->prophet = new Prophet();

            $registry = $this->prophet->prophesize('expect\MatcherRegistry');
            $registry->register(Argument::type('expect\package\MatcherClass'))
                ->shouldBeCalledTimes(1); //ToEql only

            $this->registry = $registry->reveal();
            $this->package = new MatcherPackage('expect\fixture\matcher', __DIR__ . '/fixtures/matcher');
        });
        it('package register', function () {
            $this->package->registerTo($this->registry);
            $this->prophet->checkPredictions();
        });
    });

    describe('#fromPackageFile', function () {
        beforeEach(function () {
            $this->prophet = new Prophet();

            $registry = $this->prophet->prophesize('expect\MatcherRegistry');
            $registry->register(Argument::type('expect\package\MatcherClass'))
                ->shouldBeCalledTimes(1); //ToEql only

            $this->registry = $registry->reveal();
            $this->package = MatcherPackage::fromPackageFile(__DIR__ . '/fixtures/composer.json');
        });
        it('return matcher package', function () {
            $this->package->registerTo($this->registry);
            $this->prophet->checkPredictions();
        });
        context('when composer.json not found', function () {
            it('throw ComposerJsonNotFoundException exception', function () {
                $thrownException = null;

                try {
                    MatcherPackage::fromPackageFile('not_found_composer.json');
                } catch (ComposerJsonNotFoundException $exception) {
                    $thrownException = $exception;
                }
                Assertion::isInstanceOf($thrownException, 'expect\package\ComposerJsonNotFoundException');
            });
        });
    });
});
