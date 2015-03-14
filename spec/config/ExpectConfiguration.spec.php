<?php

use expect\config\ExpectConfiguration;
use expect\config\ConfigurationFileNotFoundException;
use Assert\Assertion;


describe('ExpectConfiguration', function() {
    beforeEach(function() {
        $this->config = ExpectConfiguration::loadFromFile(__DIR__ . '/../fixtures/config.toml');
    });
    describe('#loadFromFile', function() {
        it('return ExpectConfiguration instance', function() {
            Assertion::isInstanceOf($this->config, 'expect\config\ExpectConfiguration');
        });
        context('when config file not found', function() {
            it('throw ConfigurationFileNotFoundException', function() {
                $throwExpection = false;

                try {
                    ExpectConfiguration::loadFromFile(__DIR__ . '/fixtures/not_found_config.toml');
                } catch (ConfigurationFileNotFoundException $exception) {
                    $throwExpection = true;
                }
                Assertion::true($throwExpection);
            });
        });
    });
    describe('#getResultReporter', function() {
        it('return expect\ResultReporter', function() {
            Assertion::isInstanceOf($this->config->getResultReporter(), 'expect\ResultReporter');
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
