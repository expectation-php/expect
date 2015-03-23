<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\Expect;
use expect\configurator\FileConfigurator;

$configurator = new FileConfigurator(__DIR__ . '/config.toml');
Expect::configure($configurator);

Expect::that([ 'foo' => 1 ])->toHaveKey('foo'); //pass
Expect::that([ 'foo' => 1 ])->toHaveKey('bar'); //failed
