<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\Expect;
use expect\configurator\FileConfigurator;

$configurator = new FileConfigurator(__DIR__ . '/config.toml');
Expect::configure($configurator);

Expect::that(1)->toBeAn('integer'); //pass
Expect::that('foo')->toBeAn('integer'); //failed
Expect::that('foo')->toBeInteger(); //failed

Expect::that('foo')->toBeAn('string'); //pass
Expect::that(1)->toBeAn('string'); //failed
Expect::that('foo')->toBeString(); //failed

Expect::that(1.1)->toBeAn('float'); //pass
Expect::that('foo')->toBeAn('float'); //failed
Expect::that('foo')->toBeFloat(); //failed

Expect::that(true)->toBeAn('boolean'); //pass
Expect::that('foo')->toBeAn('boolean'); //failed
Expect::that('foo')->toBeBoolean(); //failed

Expect::that(1)->toBeA('integer'); //pass
Expect::that('foo')->toBeA('integer'); //failed
