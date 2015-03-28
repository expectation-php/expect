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

/**
 * Verify whether a particular instance.
 *
 * <code>
 * $matcher = new ToBeAnInstanceOf('stdClass');
 * $matcher->match(new stdClass()); //return true
 *
 * $matcher->match(new Exception()); //return false
 * </code>
 *
 * @package expect\matcher
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
final class ToBeAnInstanceOf implements ReportableMatcher
{

    /**
     * @var mixed
     */
    private $actual;

    /**
     * @var string
     */
    private $expected;

    /**
     * @var string
     */
    private $className;

    /**
     * Create a new matcher
     *
     * @param string $expected
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
        $this->className = get_class($this->actual);

        return $this->actual instanceof $this->expected;
    }

    /**
     * {@inheritdoc}
     */
    public function reportFailed(FailedMessage $message)
    {
        $message->appendText('Expected ')
            ->appendText($this->className)
            ->appendText(' to be an instance of ')
            ->appendText($this->expected)
            ->appendText("\n\n")
            ->appendText('    expected: ')
            ->appendText($this->expected)
            ->appendText("\n")
            ->appendText('         got: ')
            ->appendText($this->className);
    }

    /**
     * {@inheritdoc}
     */
    public function reportNegativeFailed(FailedMessage $message)
    {
        $message->appendText('Expected ')
            ->appendText($this->className)
            ->appendText(' not to be an instance of ')
            ->appendText($this->expected)
            ->appendText("\n\n")
            ->appendText('    expected not: ')
            ->appendText($this->expected)
            ->appendText("\n")
            ->appendText('             got: ')
            ->appendText($this->className);
    }
}
