<?php

use Assert\Assertion;
use expect\configurator\FileConfigurator;
use expect\Expect;
use expect\Context;

describe('Utility', function () {
    beforeEach(function () {
        $toml = __DIR__ . '/fixtures/config.toml';
        $configurator = new FileConfigurator($toml);

        Expect::configure($configurator);
    });
    describe('expect()', function () {
        it('configure expect package', function () {
            $context = \expect\expect(true);
            Assertion::isInstanceOf($context, Context::class);
        });
    });
});
