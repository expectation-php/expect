<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace expect\package;

use FilesystemIterator;
use Iterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use SplFileInfo;

class ReflectionIterator implements Iterator
{
    private $iterator;
    private $namespace;
    private $namespaceDirectory;

    /**
     * @param string $namespace
     * @param string $namespaceDirectory
     */
    public function __construct($namespace, $namespaceDirectory)
    {
        $this->namespace = $namespace;
        $this->namespaceDirectory = $namespaceDirectory;
        $this->iterator = $this->createIterator($this->namespaceDirectory);
    }

    /**
     * @return \expect\package\MatcherClass
     */
    public function current()
    {
        $classFile = $this->iterator->current();
        $className = $this->getClassFullNameFromFile($classFile);

        return new ReflectionClass($className);
    }

    public function key()
    {
        return realpath($this->iterator->key());
    }

    public function next()
    {
        $this->iterator->next();
    }

    public function rewind()
    {
        $this->iterator->rewind();
    }

    public function valid()
    {
        return $this->iterator->valid();
    }

    /**
     * @param SplFileInfo $file
     *
     * @return mixed
     */
    private function getClassFullNameFromFile(SplFileInfo $file)
    {
        $targets = [
            realpath($this->namespaceDirectory)."/",
            ".php",
        ];

        $replaceValues = ["", ""];

        $className = str_replace($targets, $replaceValues, realpath($file->getPathname()));
        $className = str_replace("/", "\\", $className);

        return $this->namespace."\\".$className;
    }

    /**
     * @param string $directory
     *
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
