<?php

use Assert\Assertion;
use expect\package\MatcherClass;
use expect\registry\DefaultMatcherRegistry;
use expect\registry\MatcherAlreadyRegisteredException;
use expect\registry\MatcherNotRegisteredException;

describe('DefaultMatcherRegistry', function () {

    describe('#register', function () {
        beforeEach(function () {
            $a = new MatcherClass('\\expect\\matcher', 'ToEqual');

            $this->registry = new DefaultMatcherRegistry();
            $this->registry->register($a);
        });

        context('when matcher already registered', function () {
            it('throw MatcherAlreadyRegistered', function () {
                $thrownException = false;
                $b = new MatcherClass('\\expect\\matcher', 'ToEqual');

                try {
                    $this->registry->register($b);
                } catch (MatcherAlreadyRegisteredException $exception) {
                    $thrownException = true;
                }
                Assertion::true($thrownException);
            });
        });

    });

    describe('#get', function () {
        beforeEach(function () {
            $a = new MatcherClass('\\expect\\matcher', 'ToEqual');

            $this->registry = new DefaultMatcherRegistry();
            $this->registry->register($a);
        });
        context('when matcher registered', function () {
            it('return matcher class', function () {
                $result = $this->registry->get('toEqual');
                Assertion::isInstanceOf($result, 'expect\package\MatcherClass');
            });
        });
        context('when matcher not registered', function () {
            it('throw MatcherNotRegisteredException', function () {
                $thrownException = false;

                try {
                    $this->registry->get('foo');
                } catch (MatcherNotRegisteredException $exception) {
                    $thrownException = true;
                }
                Assertion::true($thrownException);
            });
        });
    });

    describe('#has', function () {
        beforeEach(function () {
            $this->registry = new DefaultMatcherRegistry();
        });
        context('when have matcher', function () {
            it('return true', function () {
                $this->registry->register(new MatcherClass('\\expect\\matcher', 'ToEqual'));
                $result = $this->registry->has('toEqual');

                Assertion::true($result);
            });
        });
        context('when have not matcher', function () {
            it('return false', function () {
                $result = $this->registry->has('foo');

                Assertion::false($result);
            });
        });
    });
    describe('#toDictionary', function () {
        beforeEach(function () {
            $registry = new DefaultMatcherRegistry();
            $registry->register(new MatcherClass('\\expect\\matcher', 'ToEqual'));

            $this->dictionary = $registry->toDictionary();
        });
        it('return expect\MatcherContainer instance', function () {
            Assertion::isInstanceOf($this->dictionary, 'expect\MatcherContainer');
        });
        context('when have one matcher', function () {
            it('return dictionay have one matcher', function () {
                Assertion::count($this->dictionary, 1);
            });
        });
    });

});
