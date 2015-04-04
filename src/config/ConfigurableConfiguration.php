<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace expect\config;

use expect\Configuration;

/**
 * Implement of Configuration
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
trait ConfigurableConfiguration
{
    /**
     * @var \expect\ResultReporter|null
     */
    private $resultReporter = null;

    /**
     * @var \expect\PackageRegistrar[]
     */
    private $matcherRegistrars = [];

    /**
     * {@inheritdoc}
     */
    public function getResultReporter()
    {
        return $this->resultReporter;
    }

    /**
     * {@inheritdoc}
     */
    public function getMatcherRegistrars()
    {
        return $this->matcherRegistrars;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(Configuration $config)
    {
        $matcherRegistrars = array_merge(
            $this->matcherRegistrars,
            $config->getMatcherRegistrars()
        );

        $reporter = $config->getResultReporter();

        if ($reporter === null) {
            $reporter = $this->resultReporter;
        }

        return new RuntimeConfiguration($matcherRegistrars, $reporter);
    }
}
