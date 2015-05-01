<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use DomainException;
use expect\configurator\FileConfigurator;
use expect\Expect;
use RuntimeException;

$configurator = new FileConfigurator(__DIR__ . '/config.toml');
Expect::configure($configurator);

Expect::that(function () {
    throw new RuntimeException();
})->toThrow(RuntimeException::class); //pass

Expect::that(function () {
    //Not do anything
})->toThrow(RuntimeException::class); //failed

Expect::that(function () {
    throw new DomainException();
})->toThrow(RuntimeException::class); //failed
