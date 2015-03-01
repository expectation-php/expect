<?php

namespace expect;


class DefaultMatcherFactory implements MatcherFactory
{

    private $dictionary;


    public function __construct(array $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function create($name, array $arguments = [])
    {
        $matcher = null;
        $matcherClassName = $this->dictionary[$name];

        if (count($arguments) <= 0) {
            $matcher = new $matcherClassName();
        } else if (count($arguments) === 1) {
            $matcher = new $matcherClassName($arguments[0]);
        } else {
            $matcher = new $matcherClassName($arguments);
        }

        return $matcher;
    }

}
