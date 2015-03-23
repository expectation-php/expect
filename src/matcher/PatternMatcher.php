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


/**
 * Class PatternMatcher
 * @package expect\matcher
 */
final class PatternMatcher implements Matcher
{

    /**
     * @var string
     */
    private $actual;

    /**
     * @var string
     */
    private $expected;

    /**
     * @param string $expected String of a regular expression
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
        return (preg_match($this->expected, $this->actual) === 1);
    }

}
