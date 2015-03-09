<?php

use expect\Expect;
use expect\DefaultContextLoader;
use Assert\Assertion;


describe('Expect', function() {
    beforeEach(function() {
        $toml = __DIR__ . '/fixtures/config.toml';
        $loader = new DefaultContextLoader($toml);
        Expect::configure($loader);
    });
    describe('#that', function() {
        it('configure expect package', function() {
            $result = Expect::that(true)->toEql(true);
            Assertion::true($result->isPassed());
        });
    });
});
