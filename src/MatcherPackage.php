<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace expect;

use ArrayIterator;
use expect\package\ComposerJsonNotFoundException;
use expect\package\MatcherClass;
use expect\package\ReflectionIterator;
use expect\matcher\ReportableMatcher;
use Noodlehaus\Config;

/**
 * Matcher package
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class MatcherPackage implements RegisterablePackage
{

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $namespaceDirectory;

    /**
     * Create a new macther package
     *
     * @param string $namespace          namespace of package
     * @param string $namespaceDirectory directory of package
     */
    public function __construct($namespace, $namespaceDirectory)
    {
        $this->namespace = $this->normalizeNamespace($namespace);
        $this->namespaceDirectory = $namespaceDirectory;
    }

    /**
     * {@inheritdoc}
     */
    public function registerTo(MatcherRegistry $registry)
    {
        $provideMatchers = $this->getProvideMatchers();

        foreach ($provideMatchers as $provideMatcher) {
            $registry->register($provideMatcher);
        }
    }

    /**
     * @return ArrayIterator
     */
    private function getProvideMatchers()
    {
        $matchers = [];
        $reflectionIterator = new ReflectionIterator(
            $this->namespace,
            $this->namespaceDirectory
        );

        foreach ($reflectionIterator as $reflection) {
            if ($reflection->implementsInterface(ReportableMatcher::class) === false) {
                continue;
            }

            $matchers[] = new MatcherClass(
                $reflection->getNamespaceName(),
                $reflection->getShortName()
            );
        }

        return new ArrayIterator($matchers);
    }

    private function normalizeNamespace($namespace)
    {
        $normalizeNamespace = $namespace;
        $lastCharAt = strlen($namespace) - 1;

        if (substr($namespace, $lastCharAt) === '\\') {
            $normalizeNamespace = substr($namespace, 0, $lastCharAt);
        }

        return $normalizeNamespace;
    }

    /**
     * Create a new matcher package from composer.json
     *
     * @param string $composerJson composer.json path
     *
     * @throws \expect\package\ComposerJsonNotFoundException
     */
    public static function fromPackageFile($composerJson)
    {
        if (file_exists($composerJson) === false) {
            throw new ComposerJsonNotFoundException("File {$composerJson} not found.");
        }

        $config = Config::load($composerJson);
        $autoload = $config->get('autoload.psr-4');

        $composerJsonDirectory = dirname($composerJson);

        $keys = array_keys($autoload);
        $namespace = array_shift($keys);

        $values = array_values($autoload);
        $namespaceDirectory = array_shift($values);
        $namespaceDirectory = realpath($composerJsonDirectory . '/' . $namespaceDirectory);

        return new self($namespace, $namespaceDirectory);
    }
}
