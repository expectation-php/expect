<?php

use Evenement\EventEmitterInterface;
use cloak\peridot\CloakPlugin;
use Peridot\Reporter\Dot\DotReporterPlugin;

return function(EventEmitterInterface $emitter) {

    /**
     * Since there are implementation bugs hhvm of code coverage analysis,
     * I will measure the coverage only when the php.
     */
    if (defined('HHVM_VERSION') === false) {
        CloakPlugin::create('cloak.toml')->registerTo($emitter);
    }

    (new DotReporterPlugin($emitter));
};
