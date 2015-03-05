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


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Iterator;
use SplFileInfo;
use FilesystemIterator;


class MatcherClassIterator implements Iterator
{


    private $iterator;
    private $namespace;


    /**
     * @param string $namespace
     * @param string $namespaceDirectory
     */
    public function __construct($namespace, $namespaceDirectory)
    {
        $this->namespace = $namespace;
        $this->iterator = $this->createIterator($namespaceDirectory);
    }

    /**
     * @return \expect\package\MatcherClass
     */
    public function current()
    {
        $classFile = $this->iterator->current();

        $fileName = $classFile->getFilename();
        $fileName = str_replace('.php', '', $fileName);

        $matcherClass = new MatcherClass($this->namespace, $fileName);
        return $matcherClass;
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
