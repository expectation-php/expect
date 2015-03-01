<?php

namespace expect;


use Easy\Collections\Dictionary;


class DefaultMatcherFactory implements MatcherFactory
{

    private $matchers;


    public function __construct(array $matchers)
    {
        $this->matchers = Dictionary::fromArray($matchers);
    }

    public function create($name, array $arguments = [])
    {
        $matcher = null;
        $matcherClassName = $this->matchers->get($name);

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
