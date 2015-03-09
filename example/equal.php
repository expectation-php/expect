<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\Expect;
use expect\DefaultContextLoader;

$contextLoader = new DefaultContextLoader(__DIR__ . '/config.toml');
Expect::configure($contextLoader);

Expect::that(true)->toEql(true);
Expect::that(false)->toEql(true);
