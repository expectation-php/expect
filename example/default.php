<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\configurator\DefaultConfigurator;
use expect\Expect;

$configurator = new DefaultConfigurator();
Expect::configure($configurator);

Expect::that('foo')->toEqual('foo'); //pass
Expect::that('foo')->toEqual('bar'); //failed
