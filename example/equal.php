<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\configurator\FileConfigurator;
use expect\Expect;

$configurator = new FileConfigurator(__DIR__ . '/config.toml');
Expect::configure($configurator);

Expect::that(true)->toEqual(true);
Expect::that(false)->toEqual(true);

Expect::that(true)->toBeTrue();
Expect::that(false)->toBeTrue();

Expect::that(false)->toBeFalse();
Expect::that(true)->toBeFalse();

Expect::that(null)->toBeNull();
Expect::that(100)->toBeNull();
