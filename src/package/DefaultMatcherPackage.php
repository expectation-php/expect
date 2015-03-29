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

use expect\MatcherPackage;
use expect\MatcherRegistry;
use expect\RegisterablePackage;


/**
 * Default matcher package
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class DefaultMatcherPackage implements RegisterablePackage
{

    /**
     * @var string
     */
    private $matcherNamespace;

    /**
     * @var string
     */
    private $matcherDirectory;

    /**
     * Create a new matcher package
     */
    public function __construct()
    {
        $this->matcherNamespace = '\\expect\\matcher';
        $this->matcherDirectory = realpath(__DIR__ . '/../matcher');
    }

    /**
     * {@inheritdoc}
     */
    public function registerTo(MatcherRegistry $registry)
    {
        $matcherPackage = new MatcherPackage(
            $this->matcherNamespace,
            $this->matcherDirectory
        );
        $matcherPackage->registerTo($registry);
    }
}
