<?php

use expect\Configuration;
use expect\EvaluateContext;
use Assert\Assertion;


describe('EvaluateContext', function() {
    beforeEach(function() {
        $config = Configuration::loadFromFile(__DIR__ . '/fixtures/config.toml');
        $this->context = EvaluateContext::fromConfiguration($config);
    });
    describe('#fromConfiguration', function() {
        describe('#getResultReporter', function() {
            it('return expect\ResultReporter', function() {
                Assertion::isInstanceOf($this->context->getResultReporter(), 'expect\ResultReporter');
            });
        });
    });
});
