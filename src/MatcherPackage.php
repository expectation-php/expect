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
        $classFileIterator = $this->createIterator($this->namespaceDirectory);

        foreach ($classFileIterator as $classFile) {
            $className = $this->getClassFullNameFromFile($classFile);
            $reflection = new ReflectionClass($className);

            if ($reflection->implementsInterface('\expect\Matcher') === false) {
                continue;
            }

            $matchers[] = new MatcherClass(
                $reflection->getNamespaceName(),
                $reflection->getShortName()
            );
        }

        return new ArrayIterator($matchers);
    }


    /**
     * @param SplFileInfo $file
     * @return mixed
     */
    private function getClassFullNameFromFile(SplFileInfo $file)
    {
        $targets = [
            realpath($this->namespaceDirectory) . "/",
            ".php"
        ];
        $replaceValues = ["", ""];

        $className = str_replace($targets, $replaceValues, realpath($file->getPathname()));
        $className = str_replace("/", "\\", $className);

        return $this->namespace . "\\" . $className;
    }

    /**
     * @param string $directory
     * @return RecursiveIteratorIterator
     */
    private function createIterator($directory)
    {
        $directoryIterator = new RecursiveDirectoryIterator($directory,
            FilesystemIterator::CURRENT_AS_FILEINFO |
            FilesystemIterator::KEY_AS_PATHNAME |
            FilesystemIterator::SKIP_DOTS
        );

        $filterIterator = new RecursiveIteratorIterator($directoryIterator,
            RecursiveIteratorIterator::LEAVES_ONLY);

        return $filterIterator;
    }

}
