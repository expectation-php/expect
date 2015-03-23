<?php

use expect\matcher\strategy\ArrayInclusionStrategy;
use Assert\Assertion;

describe('ArrayInclusionStrategy', function() {
    beforeEach(function() {
        $this->strategy = new ArrayInclusionStrategy([1, 2]);
    });
    describe('#match', function() {
        beforeEach(function() {
            $this->result = $this->strategy->match([1, 2, 3]);
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
                Assertion::count($this->matchResults, 2);
                Assertion::same($this->matchResults[0], 1);
                Assertion::same($this->matchResults[1], 2);
            });
            it('has unmatch results', function() {
                Assertion::count($this->unmatchResults, 1);
                Assertion::same($this->unmatchResults[0], 3);
            });
        });
    });
});
