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
    /**
     * @var ReflectionClass
     */
    private $reflection;

    public function __construct($namespace, $className)
    {
        $matcherClassName = $namespace . '\\' . $className;
        $this->reflection = new ReflectionClass($matcherClassName);
    }

    public function getName()
    {
        return $this->reflection->getName();
    }

    public function getClassName()
    {
        return $this->reflection->getShortName();
    }

    public function newInstance(array $arguments = [])
    {
        return $this->reflection->newInstanceArgs($arguments);
    }

    public function __toString()
    {
        return $this->getName();
    }
}
