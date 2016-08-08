<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace expect\config;

use expect\Dictionary;
use ReflectionClass;
use RuntimeException;
use Yosymfony\Toml\Toml;

class ConfigurationLoader
{
    const REPORTER = '\expect\ResultReporter';
    const PACKAGE_REGISTRAR = '\expect\PackageRegistrar';

    public function loadFromFile($file)
    {
        if (file_exists($file) === false) {
            throw new ConfigurationFileNotFoundException("$file not found");
        }
        $values = Toml::parse($file);

        $defaultConfig = new DefaultConfiguration();
        $runtimeConfig = $this->loadFromArray($values);

        return $defaultConfig->merge($runtimeConfig);
    }

    public function loadFromArray(array $values)
    {
        $config = Dictionary::fromArray($values);
        $loadedPackages = [];
        $loadedReporter = null;

        if ($config->containsKey('packages')) {
            $packages = $config->get('packages');
            $loadedPackages = $this->createPackages($packages->toArray());
        }

        if ($config->containsKey('reporter')) {
            $reporter = $config->get('reporter');
            $loadedReporter = $this->createReporter($reporter);
        }

        return new RuntimeConfiguration($loadedPackages, $loadedReporter);
    }

    /**
     * Create a few new package registrars
     *
     * @param array $packages
     *
     * @return \expect\PackageRegistrar[]
     */
    private function createPackages(array $packages)
    {
        $matcherPackages = [];

        foreach ($packages as $package) {
            $reflection = new ReflectionClass($package);

            if ($reflection->implementsInterface(self::PACKAGE_REGISTRAR) === false) {
                throw NotAvailableException::createForPackage(self::PACKAGE_REGISTRAR);
            }
            $matcherPackages[] = $reflection->newInstance();
        }

        return $matcherPackages;
    }

    /**
     * Create a new result reporter
     *
     * @param string $reporter
     *
     * @return \expect\ResultReporter
     */
    private function createReporter($reporter)
    {
        $reflection = new ReflectionClass($reporter);

        if ($reflection->implementsInterface(self::REPORTER) === false) {
            throw NotAvailableException::createForReporter(self::REPORTER);
        }

        return $reflection->newInstance();
    }
}
