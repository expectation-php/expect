<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\Expect;
use expect\configurator\FileConfigurator;

$configurator = new FileConfigurator(__DIR__ . '/config.toml');
Expect::configure($configurator);

Expect::that('foo')->toContain('foo'); //pass
Expect::that('foo')->toContain('foo', 'bar'); //failed

Expect::that([ 'foo', 'bar' ])->toContain('foo'); //pass
Expect::that([ 'foo', 'bar' ])->toContain('foo', 'bar'); //pass
Expect::that([ 'foo', 'bar' ])->toContain('foo', 'bar', 'bar1'); //failed
