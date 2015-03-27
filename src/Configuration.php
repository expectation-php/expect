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

interface Configuration
{
    public function getResultReporter();

    public function getMatcherPackages();

    public function merge(Configuration $config);
}
