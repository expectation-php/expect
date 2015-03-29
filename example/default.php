<?php

namespace expect\example;

require_once __DIR__ . "/../vendor/autoload.php";

use expect\Expect;

Expect::configure();

Expect::that('foo')->toEqual('foo'); //pass
Expect::that('foo')->toEqual('bar'); //failed
