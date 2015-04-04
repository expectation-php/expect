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

use Countable;
use expect\FailedMessage;

/**
 * Verify whether the value has a length that was expected.
 *
 * <code>
 * $matcher = new ToHaveLength(3);
 * $matcher->match("foo"); //return true
 *
 * $matcher->match("fo"); //return false
 * $matcher->match([ 1, 2 ]); //return false
 * $matcher->match(new ArrayIterator([ 1, 2 ])); //return false
 * <code>
 *
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToHaveLength implements ReportableMatcher
{
    /**
     * @var string|array|Countable
     */
    private $actual;

    /**
     * @var int
     */
    private $expected;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $length;

    /**
     * Create a new matcher.
     *
     * @param int $expected
     */
    public function __construct($expected)
    {
        $this->expected = $expected;
    }

    /**
     * {@inheritdoc}
     */
    public function match($actual)
    {
        $this->actual = $actual;

        if (is_string($this->actual) === true) {
            $this->type = 'string';
            $this->length = mb_strlen($this->actual);
        } elseif (is_array($this->actual) === true) {
            $this->type = 'array';
            $this->length = count($this->actual);
        } elseif ($this->actual instanceof Countable) {
            $this->type = get_class($this->actual);
            $this->length = count($this->actual);
        }

        return ($this->length === $this->expected);
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('Expected ')
            ->appendText($this->type)
            ->appendText(' to have a length of ')
            ->appendText($this->expected)
            ->appendText("\n\n")
            ->appendText('    expected: ')
            ->appendValue($this->expected)
            ->appendText("\n")
            ->appendText('      length: ')
            ->appendValue($this->length);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('Expected ')
            ->appendText($this->type)
            ->appendText(' not to have a length of ')
            ->appendValue($this->expected)
            ->appendText("\n\n")
            ->appendText('    expected not: ')
            ->appendValue($this->expected)
            ->appendText("\n")
            ->appendText('          length: ')
            ->appendValue($this->length);
    }
}
