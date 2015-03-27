<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\configurator\FileConfigurator;
use expect\Expect;

$configurator = new FileConfigurator(__DIR__ . '/config.toml');
Expect::configure($configurator);

Expect::that(function () {
    echo 'foo';
})->toPrint('foo'); //pass

Expect::that(function () {
    echo 'bar';
})->toPrint('foo'); //failed
