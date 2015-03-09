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


use expect\DefaultMatcherFactory;
use expect\DefaultMatcherRegistry;



class EvaluateContext implements Context
{

    private $factory;
    private $reporter;


    public function __construct(MatcherFactory $factory, ResultReporter $reporter)
    {
        $this->factory = $factory;
        $this->reporter = $reporter;
    }

    public function getMatcherFactory()
    {
        return $this->factory;
    }

    public function getResultReporter()
    {
        return $this->reporter;
    }

}
