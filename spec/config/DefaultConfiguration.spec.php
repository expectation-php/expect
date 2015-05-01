<?php

use Assert\Assertion;
use expect\config\DefaultConfiguration;
use expect\reporter\ExceptionReporter;

describe(DefaultConfiguration::class, function () {
    beforeEach(function () {
        $this->config = new DefaultConfiguration();
    });
    describe('#getResultReporter', function () {
        it('return expect\ExceptionReporter', function () {
            Assertion::isInstanceOf($this->config->getResultReporter(), ExceptionReporter::class);
        });
    });
    describe('#getMatcherRegistrars', function () {
        beforeEach(function () {
            $this->matcherRegistrars = $this->config->getMatcherRegistrars();
        });
        it('return matcher package registrars', function () {
            Assertion::isArray($this->matcherRegistrars);
        });
        context('when have one package registrar', function () {
            it('return one package registrar', function () {
                Assertion::count($this->matcherRegistrars, 1);
            });
        });
    });
});
