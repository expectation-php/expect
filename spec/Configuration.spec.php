<?php

use expect\Configuration;
use Assert\Assertion;

describe('Configuration', function() {
    describe('#loadFromFile', function() {
        beforeEach(function() {
            $this->config = Configuration::loadFromFile(__DIR__ . '/fixtures/config.toml');
        });
        it('return Configuration instance', function() {
        });
    });
});
