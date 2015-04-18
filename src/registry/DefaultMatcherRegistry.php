<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace expect\registry;

use Collections\Dictionary;
use expect\MatcherDictionary;
use expect\MatcherLookupTable;
use expect\MatcherRegistry;
use expect\package\MatcherClass;

final class DefaultMatcherRegistry implements MatcherRegistry
{
    use MatcherLookupTable;

    public function __construct(array $matchers = [])
    {
        $this->matchers = Dictionary::fromArray($matchers);
    }

    public function register(MatcherClass $matcherClass)
    {
        $name = $matcherClass->getClassName();
        $registerKeyName = lcfirst($name);

        if ($this->has($registerKeyName)) {
            throw new MatcherAlreadyRegisteredException("{$registerKeyName} is registered");
        }

        $this->matchers->set($registerKeyName, $matcherClass);
    }

    public function count()
    {
        return count($this->matchers);
    }

    public function toDictionary()
    {
        $matchers = $this->matchers->toArray();

        return new MatcherDictionary($matchers);
    }
}
