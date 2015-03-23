<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\Expect;
use expect\configurator\FileConfigurator;


$configurator = new FileConfigurator(__DIR__ . '/config.toml');
Expect::configure($configurator);

Expect::that(true)->ToBeTruthy(); //pass
Expect::that('')->ToBeTruthy(); //pass
Expect::that(0)->ToBeTruthy(); //pass
Expect::that(false)->ToBeTruthy(); //failed

Expect::that(false)->ToBeFalsey(); //pass
Expect::that(null)->ToBeFalsey(); //pass
Expect::that('')->ToBeFalsey(); //failed
Expect::that(0)->ToBeFalsey(); //failed
