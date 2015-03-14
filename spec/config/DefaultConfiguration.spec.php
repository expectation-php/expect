<?php

use expect\config\DefaultConfiguration;
use Assert\Assertion;


describe('DefaultConfiguration', function() {
    beforeEach(function() {
        $this->config = new DefaultConfiguration();
    });
    describe('#getResultReporter', function() {
        it('return expect\ExceptionReporter', function() {
            Assertion::isInstanceOf($this->config->getResultReporter(), 'expect\reporter\ExceptionReporter');
        });
    });
    describe('#getMatcherPackages', function() {
        beforeEach(function() {
            $this->matcherPackages = $this->config->getMatcherPackages();
        });
        it('return matcher packages', function() {
            Assertion::isArray($this->matcherPackages);
        });
        context('when have one package', function() {
            it('return one package', function() {
                Assertion::count($this->matcherPackages, 1);
            });
        });
    });
});
