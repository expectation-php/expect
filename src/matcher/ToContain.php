<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace expect\matcher;

use expect\FailedMessage;
use expect\Matcher;
use expect\matcher\strategy\ArrayInclusionStrategy;
use expect\matcher\strategy\StringInclusionStrategy;

/**
 * Verify whether the value is all included.
 *
 * <code>
 * $matcher = new ToContain([ 'foo' ]);
 * $matcher->match('foo'); //return true
 *
 * $matcher = new ToContain([ 'foo', 'bar' ]);
 * $matcher->match('foo'); //return false
 *
 * $matcher = new ToContain([ 1, 2 ]);
 * $matcher->match([ 1, 2 ]); //return true
 * <code>
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToContain implements ReportableMatcher
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var mixed
     */
    private $actual;

    /**
     * @var \expect\matcher\strategy\InclusionResult
     */
    private $matchResult;

    /**
     * @var array
     */
    private $expectValues;

    /**
     * @param strng|array $expected
     */
    public function __construct($expected)
    {
        $this->expectValues = is_array($expected) ? $expected : [$expected];
    }

    /**
     * {@inheritdoc}
     */
    public function match($actual)
    {
        $this->actual = $actual;

        $strategy = $this->createStrategy();
        $this->matchResult = $strategy->match($this->expectValues);

        return $this->matchResult->isMatched();
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $unmatchResults = $this->matchResult->getUnmatchResults();

        $message->appendText('Expected ')
            ->appendText($this->type)
            ->appendText(' to contain ')
            ->appendValues($unmatchResults);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $matchResults = $this->matchResult->getMatchResults();

        $message->appendText('Expected ')
            ->appendText($this->type)
            ->appendText(' not to contain ')
            ->appendValues($matchResults);
    }

    private function createStrategy()
    {
        $strategy = null;

        if (is_string($this->actual)) {
            $this->type = 'string';
            $strategy = new StringInclusionStrategy($this->actual);
        } elseif (is_array($this->actual)) {
            $this->type = 'array';
            $strategy = new ArrayInclusionStrategy($this->actual);
        }

        return $strategy;
    }
}
