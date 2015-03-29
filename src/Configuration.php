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

/**
 * Configuration
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
interface Configuration
{
    /**
     * Get result reporter
     *
     * @return \expect\ResultReporter
     */
    public function getResultReporter();

    /**
     * Get matcher package registrars
     *
     * @return \expect\PackageRegistrar[] package registrars
     */
    public function getMatcherRegistrars();

    /**
     * Merge the configuration
     *
     * @param Configuration $config
     * @return Configuration merged configration
     */
    public function merge(Configuration $config);
}
