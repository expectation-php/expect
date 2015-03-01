<?php

use Evenement\EventEmitterInterface;
use cloak\peridot\CloakPlugin;

return function(EventEmitterInterface $emitter) {
    CloakPlugin::create('cloak.toml')->registerTo($emitter);
};
