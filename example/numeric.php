<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\configurator\FileConfigurator;
use expect\Expect;

$configurator = new FileConfigurator(__DIR__ . '/config.toml');
Expect::configure($configurator);

Expect::that(11)->toBeGreaterThan(10); //pass
Expect::that(10)->toBeGreaterThan(10); //pass
Expect::that(9)->toBeGreaterThan(10); //failed

Expect::that(9)->toBeLessThan(10); //pass
Expect::that(10)->toBeLessThan(10); //failed

Expect::that(11)->toBeAbove(10); //pass
Expect::that(10)->toBeAbove(10); //pass
Expect::that(9)->toBeAbove(10); //failed

Expect::that(9)->toBeBelow(10); //pass
Expect::that(10)->toBeBelow(10); //failed

Expect::that(11)->toBeWithin(10, 20); //pass
Expect::that(9)->toBeWithin(10, 20); //failed
Expect::that(21)->toBeWithin(10, 20); //failed
