<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\Expect;
use expect\DefaultContextLoader;

$loader = new DefaultContextLoader(__DIR__ . '/config.toml');
Expect::configure($loader);

Expect::that(true)->toEqual(true);
Expect::that(false)->toEqual(true);
