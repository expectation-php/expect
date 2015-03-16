<?php

use Evenement\EventEmitterInterface;
use cloak\peridot\CloakPlugin;
use Peridot\Reporter\Dot\DotReporterPlugin;

return function(EventEmitterInterface $emitter) {
    CloakPlugin::create('cloak.toml')->registerTo($emitter);
    (new DotReporterPlugin($emitter));
};
