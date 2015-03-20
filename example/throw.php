<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\Expect;
use expect\configurator\FileConfigurator;
use \RuntimeException;
use \DomainException;


$configurator = new FileConfigurator(__DIR__ . '/config.toml');
Expect::configure($configurator);

Expect::that(function() {
    throw new RuntimeException();
})->toThrow('\RuntimeException'); //pass

Expect::that(function() {
    //Not do anything
})->toThrow('\RuntimeException'); //failed

Expect::that(function() {
    throw new DomainException();
})->toThrow('\RuntimeException'); //failed
