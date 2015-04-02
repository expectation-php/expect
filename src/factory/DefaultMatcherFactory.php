<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expect\factory;

use expect\MatcherContainer;
use expect\MatcherFactory;

/**
 * Default factory of matcher.
 *
 * <code>
 * $dict = new MatcherDictionary([
 *     'toEqual' => new MatcherClass('\\expect\\matcher', 'ToEqual')
 * ]);
 * $factory = new DefaultMatcherFactory($dict);
 * $matcher = $factory->create('toEqual', [ 'foo' ]); //return \expect\matcher\ToEqual instance
 * </code>
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 *
 * @see \expect\MatcherDictionary
 * @see \expect\package\MatcherClass
 */
class DefaultMatcherFactory implements MatcherFactory
{
    /**
     * @var \expect\MatcherContainer
     */
    private $container;

    /**
     * @param \expect\MatcherContainer $container macther container
     */
    public function __construct(MatcherContainer $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function create($name, array $arguments = [])
    {
        $matcherClass = $this->container->get($name);

        if (count($arguments) <= 1) {
            $matcher = $matcherClass->newInstance($arguments);
        } else {
            $matcher = $matcherClass->newInstance([$arguments]);
        }

        return $matcher;
    }
}
