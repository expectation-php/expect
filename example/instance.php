<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\Expect;
use expect\matcher\ToEqual;
use expect\configurator\FileConfigurator;
use stdClass;


$configurator = new FileConfigurator(__DIR__ . '/config.toml');
Expect::configure($configurator);

Expect::that(new ToEqual(true))->toBeAnInstanceOf('expect\Mathcer');
Expect::that(new stdClass)->toBeAnInstanceOf('expect\Mathcer');
