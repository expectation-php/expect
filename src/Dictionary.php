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

use \OutOfBoundsException;
use \Countable;

final class Dictionary implements Countable
{

    private $values;

    public function __construct(array $values = [])
    {
        $this->values = $values;
    }

    /**
     *
     *
     * @param string $value
     *
     * @return boolean
     */
    public function containsKey($key)
    {
        return array_key_exists($key, $this->values);
    }

    /**
     * @param string $value
     * @return mixed
     */
    public function get($key)
    {
        if (!$this->containsKey($key)) {
            throw new OutOfBoundsException('No element at position ' . $key);
        }

        return $this->values[$key];
    }

    public function set($key, $value)
    {
        $this->values[$key] = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->values);
    }

    public function toArray()
    {
        return $this->values;
    }

    public static function fromArray(array $values = [])
    {
        $defaultValues = [];

        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $defaultValues[$key] = new static($value);
            } else {
                $defaultValues[$key] = $value;
            }
        }

        return new static($defaultValues);
    }

}
