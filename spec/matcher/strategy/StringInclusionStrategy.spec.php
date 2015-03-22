<?php

use expect\matcher\strategy\StringInclusionStrategy;
use Assert\Assertion;

describe('StringInclusionStrategy', function() {
    beforeEach(function() {
        $this->strategy = new StringInclusionStrategy('foo var');
    });
    describe('#match', function() {
        beforeEach(function() {
            $this->result = $this->strategy->match(['foo', 'bar']);
        });
        it('return expect\matcher\strategy\InclusionResult instance', function() {
            Assertion::isInstanceOf($this->result, 'expect\matcher\strategy\InclusionResult');
        });
        describe('result', function() {
            beforeEach(function() {
                $this->matchResults = $this->result->getMatchResults();
                $this->unmatchResults = $this->result->getUnmatchResults();
            });
            it('has match results', function() {
                Assertion::count($this->matchResults, 1);
                Assertion::same($this->matchResults[0], 'foo');
            });
            it('has unmatch results', function() {
                Assertion::count($this->unmatchResults, 1);
                Assertion::same($this->unmatchResults[0], 'bar');
            });
        });
    });
});
