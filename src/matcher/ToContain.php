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


use expect\Matcher;
use expect\FailedMessage;
use expect\matcher\strategy\StringInclusionStrategy;
use expect\matcher\strategy\ArrayInclusionStrategy;

/**
 * <code>
 * <?php
 *     Expect::that('foo')->toContain('foo'); //pass
 *     Expect::that('foo')->toContain('foo', 'bar'); //failed
 *
 *     Expect::that([ 'foo', 'bar' ])->toContain('foo'); //pass
 *     Expect::that([ 'foo', 'bar' ])->toContain('foo', 'bar'); //pass
 *     Expect::that([ 'foo', 'bar' ])->toContain('foo', 'bar', 'bar1'); //failed
 * </code>
 */
final class ToContain implements Matcher
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


    public function __construct($expected)
    {
        $this->expectValues = is_array($expected) ? $expected : [ $expected ];
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

        $message->appendText('expected ')
            ->appendText($this->type)
            ->appendText(" to contain ")
            ->appendValues($unmatchResults);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $matchResults = $this->matchResult->getMatchResults();

        $message->appendText('expected ')
            ->appendText($this->type)
            ->appendText(" not to contain ")
            ->appendValues($matchResults);
    }

    private function createStrategy()
    {
        $strategy = null;

        if (is_string($this->actual)) {
            $this->type = 'string';
            $strategy = new StringInclusionStrategy($this->actual);
        } else if (is_array($this->actual)) {
            $this->type = 'array';
            $strategy = new ArrayInclusionStrategy($this->actual);
        }

        return $strategy;
    }

}
