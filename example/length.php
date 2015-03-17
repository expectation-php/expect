<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\Expect;
use expect\configurator\FileConfigurator;
use \ArrayIterator;

$configurator = new FileConfigurator(__DIR__ . '/config.toml');
Expect::configure($configurator);


Expect::that('foobar')->toHaveLength(6); //pass
Expect::that('foobar')->toHaveLength(5); //failed

Expect::that([ 1 ])->toHaveLength(1); //pass
Expect::that([ 1, 2 ])->toHaveLength(3); //failed

Expect::that(new ArrayIterator([ 1 ]))->toHaveLength(1); //pass
Expect::that(new ArrayIterator([ 1, 2 ]))->toHaveLength(3); //failed

Expect::that([])->toBeEmpty(); //pass
Expect::that([ 1 ])->toBeEmpty(); //failed
