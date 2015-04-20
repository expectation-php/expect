<?php

use cloak\peridot\CloakPlugin;
use holyshared\fixture\peridot\FileFixturePlugin;
use Evenement\EventEmitterInterface;
use Peridot\Reporter\Dot\DotReporterPlugin;

return function (EventEmitterInterface $emitter) {

    /*
     * Since there are implementation bugs hhvm of code coverage analysis,
     * I will measure the coverage only when the php.
     */
    if (defined('HHVM_VERSION') === false) {
        CloakPlugin::create('.cloak.toml')->registerTo($emitter);
    }

    $plugin = new FileFixturePlugin(__DIR__ . '/spec/fixtures/.fixtures.toml');
    $plugin->registerTo($emitter);

    (new DotReporterPlugin($emitter));
};
