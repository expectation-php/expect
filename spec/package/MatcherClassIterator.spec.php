<?php

use expect\package\MatcherClassIterator;
use Assert\Assertion;


xdescribe('MatcherClassIterator', function() {
    beforeEach(function() {
        $this->iterator = new MatcherClassIterator('expect\\matcher', __DIR__ . '../../src/matcher');
    });
    xdescribe('#current', function() {
        xit('return current matcher class');
    });
    xdescribe('#key', function() {
        xit('return current key');
    });
    xdescribe('#next', function() {
        xit('move next matcher class');
    });
    xdescribe('#rewind', function() {
        xit('move first');
    });
    xdescribe('#valid', function() {
        xcontext('when have elements', function() {
            xit('return true');
        });
    });
});
