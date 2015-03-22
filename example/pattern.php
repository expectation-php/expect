<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\Expect;
use expect\configurator\FileConfigurator;

$configurator = new FileConfigurator(__DIR__ . '/config.toml');
Expect::configure($configurator);


Expect::that('foobar')->toMatch('/foo/'); //pass
Expect::that('foobar')->toMatch('/cat/'); //failed

Expect::that('foobar')->toStartWith('foo'); //pass
Expect::that('foobar')->toStartWith('cat'); //failed

Expect::that('foobar')->toEndWith('bar'); //pass
Expect::that('foobar')->toEndWith('cat'); //failed
