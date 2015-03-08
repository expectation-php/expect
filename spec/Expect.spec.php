<?php

use expect\Expect;
use Assert\Assertion;


describe('Expect', function() {
    describe('#configure', function() {
        it('configure expect package', function() {
            $tomlConfig = __DIR__ . '/fixtures/config.toml';
            Expect::configure($tomlConfig);
        });
    });
});
