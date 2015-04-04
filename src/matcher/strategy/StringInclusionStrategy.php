<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace expect\matcher\strategy;

final class StringInclusionStrategy implements InclusionStrategy
{
    /**
     * @var string
     */
    private $actualValue;

    /**
     * @param string actualValues
     */
    public function __construct($actualValue)
    {
        $this->actualValue = $actualValue;
    }

    /**
     * <code>
     * <?php
     *     $strategy = new StringInclusionStrategy('foo');
     *     $result = $strategy->match([ 'foo', 'bar' ]);.
     *
     *     var_dump($result->isMatched()) // true
     *     var_dump($result->getMatchResults()); // ['foo']
     *     var_dump($result->getUnmatchResults()); // ['bar']
     * ?>
     * </code>
     *
     * @param array expectValues
     */
    public function match(array $expectValues)
    {
        $matchResults = [];
        $unmatchResults = [];

        foreach ($expectValues as $expectValue) {
            $position = strpos($this->actualValue, $expectValue);
            if ($position !== false) {
                $matchResults[] = $expectValue;
            } else {
                $unmatchResults[] = $expectValue;
            }
        }

        return new InclusionResult($expectValues, $matchResults, $unmatchResults);
    }
}
