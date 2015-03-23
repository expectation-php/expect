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


use expect\package\MatcherClass;
use expect\package\ReflectionIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use IteratorAggregate;
use SplFileInfo;
use FilesystemIterator;
use ReflectionClass;
use ArrayIterator;


class MatcherPackage implements RegisterablePackage
{


    private $namespace;
    private $namespaceDirectory;


    /**
     * @param string $namespaceDirectory
     */
    public function __construct($namespace, $namespaceDirectory)
    {
        $this->namespace = $namespace;
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


    private function getProvideMatchers()
    {
        $matchers = [];
        $reflectionIterator = new ReflectionIterator(
            $this->namespace,
            $this->namespaceDirectory
        );

        foreach ($reflectionIterator as $reflection) {
            if ($reflection->implementsInterface('\expect\matcher\ReportableMatcher') === false) {
                continue;
            }

            $matchers[] = new MatcherClass(
                $reflection->getNamespaceName(),
                $reflection->getShortName()
            );
        }

        return new ArrayIterator($matchers);
    }

}
