<?php

namespace expect;


interface MatcherFactory
{

    public function create($name, array $arguments = []);

}
