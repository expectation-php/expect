<?php

use expect\Expect;
use expect\DefaultConfigurator;
use Assert\Assertion;


describe('Expect', function() {
    beforeEach(function() {
        $toml = __DIR__ . '/fixtures/config.toml';
        $configurator = new DefaultConfigurator($toml);
        Expect::configure($configurator);
    });
    describe('#that', function() {
        it('configure expect package', function() {
            $result = Expect::that(true)->toEql(true);
            Assertion::true($result->isPassed());
        });
    });
});
