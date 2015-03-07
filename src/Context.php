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


interface Context
{

    /**
     * @return \expect\MatcherFactory
     */
    public function getMatcherFactory();

    /**
     * @return \expect\ResultReporter
     */
    public function getResultReporter();

}
