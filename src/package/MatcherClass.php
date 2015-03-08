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


use ReflectionClass;


class MatcherClass
{

    private $namespace;
    private $className;

    public function __construct($namespace, $className)
    {
        $this->namespace = $namespace;
        $this->className = $className;
    }

    public function getName()
    {
        return $this->namespace . '\\' . $this->className;
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function newInstance(array $arguments = [])
    {
        $className = $this->getName();
        $reflectionClass = new ReflectionClass($className);

        return $reflectionClass->newInstanceArgs($arguments);
    }

    public function __toString()
    {
        return $this->getName();
    }

}
