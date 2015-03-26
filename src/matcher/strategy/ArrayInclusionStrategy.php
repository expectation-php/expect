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

final class ArrayInclusionStrategy implements InclusionStrategy
{
    /**
     * @var array
     */
    private $actualValues;

    /**
     * @param array actualValues
     */
    public function __construct(array $actualValues)
    {
        $this->actualValues = $actualValues;
    }

    /**
     * <code>
     * <?php
     *     $strategy = new ArrayInclusionStrategy([ 1, 2 ]);
     *     $result = $strategy->match([ 1, 2, 3 ]);.
     *
     *     var_dump($result->isMatched()) // true
     *     var_dump($result->getMatchResults()); // [ 1, 2 ]
     *     var_dump($result->getUnmatchResults()); // [ 3 ]
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
            if (in_array($expectValue, $this->actualValues)) {
                $matchResults[] = $expectValue;
            } else {
                $unmatchResults[] = $expectValue;
            }
        }

        return new InclusionResult($expectValues, $matchResults, $unmatchResults);
    }
}
