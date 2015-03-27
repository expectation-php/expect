<?php

use Assert\Assertion;
use expect\configurator\FileConfigurator;
use expect\Expect;

describe('Expect', function () {
    beforeEach(function () {
        $toml = __DIR__ . '/fixtures/config.toml';
        $configurator = new FileConfigurator($toml);

        Expect::configure($configurator);
    });
    describe('#that', function () {
        it('configure expect package', function () {
            $context = Expect::that(true);
            Assertion::isInstanceOf($context, 'expect\Context');
        });
    });
});
