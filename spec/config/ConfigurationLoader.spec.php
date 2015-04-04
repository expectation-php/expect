<?php

use Assert\Assertion;
use expect\config\ConfigurationFileNotFoundException;
use expect\config\ConfigurationLoader;
use expect\config\NotAvailableException;

describe('ConfigurationLoader', function () {
    describe('#loadFromFile', function () {
        context('when config file found', function () {
            beforeEach(function () {
                $this->loader = new ConfigurationLoader();
                $this->config = $this->loader->loadFromFile(__DIR__ . '/../fixtures/config.toml');
            });
            it('return Configuration instance', function () {
                Assertion::isInstanceOf($this->config, 'expect\Configuration');
            });
            it('have matcher package registrars', function () {
                $registrars = $this->config->getMatcherRegistrars();
                Assertion::count($registrars, 2);
            });
        });
        context('when config file not found', function () {
            it('throw ConfigurationFileNotFoundException', function () {
                $throwException = false;

                try {
                    $this->loader->loadFromFile(__DIR__ . '/fixtures/not_found_config.toml');
                } catch (ConfigurationFileNotFoundException $exception) {
                    $throwException = true;
                }
                Assertion::true($throwException);
            });
        });
        context('when can not load reporter', function () {
            it('throw NotAvailableException', function () {
                $throwException = false;

                try {
                    $this->loader->loadFromFile(__DIR__ . '/../fixtures/not_available_reporter.toml');
                } catch (NotAvailableException $exception) {
                    $throwException = true;
                }
                Assertion::true($throwException);
            });
        });
        context('when can not load packages', function () {
            it('throw NotAvailableException', function () {
                $throwException = false;

                try {
                    $this->loader->loadFromFile(__DIR__ . '/../fixtures/not_available_package_registrar.toml');
                } catch (NotAvailableException $exception) {
                    $throwException = true;
                }
                Assertion::true($throwException);
            });
        });
    });
});
