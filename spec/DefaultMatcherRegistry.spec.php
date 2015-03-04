<?php

use expect\DefaultMatcherRegistry;
use expect\package\MatcherClass;
use Assert\Assertion;


describe('DefaultMatcherRegistry', function() {

    describe('#has', function() {
        beforeEach(function() {
            $this->registry = new DefaultMatcherRegistry();
        });
        context('when have matcher', function() {
            it('return true', function() {
                $this->registry->register( new MatcherClass('\\expect\\matcher', 'ToEqual') );
                $result = $this->registry->has('ToEqual');

                Assertion::true($result);
            });
        });
        context('when have not matcher', function() {
            it('return false', function() {
                $result = $this->registry->has('foo');

                Assertion::false($result);
            });
        });
    });

});
