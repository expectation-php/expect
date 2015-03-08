<?php

use expect\Expect;
use Assert\Assertion;


describe('Expect', function() {
    beforeEach(function() {
        $this->toml = __DIR__ . '/fixtures/config.toml';
        Expect::configure($this->toml);
    });
    describe('#that', function() {
        it('configure expect package', function() {
            $result = Expect::that(true)->toEql(true);
            Assertion::true($result->isPassed());
        });
    });
});
