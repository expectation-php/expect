<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expect\context;

use expect\ContextFactory;
use expect\MatcherFactory;
use expect\ResultReporter;

class DefaultContextFactory implements ContextFactory
{
    private $factory;
    private $reporter;

    public function __construct(MatcherFactory $factory, ResultReporter $reporter)
    {
        $this->factory = $factory;
        $this->reporter = $reporter;
    }

    /**
     * {@inheritdoc}
     */
    public function newContext()
    {
        return new EvaluateContext($this->factory, $this->reporter);
    }
}
