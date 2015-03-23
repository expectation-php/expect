expect
========================

[![Build Status](https://travis-ci.org/expectation-php/expect.svg?branch=master)](https://travis-ci.org/expectation-php/expect)
[![HHVM Status](http://hhvm.h4cc.de/badge/expect/expect.svg)](http://hhvm.h4cc.de/package/expect/expect)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/expectation-php/expect/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/expectation-php/expect/?branch=master)
[![Coverage Status](https://coveralls.io/repos/expectation-php/expect/badge.svg)](https://coveralls.io/r/expectation-php/expect)
[![Stories in Ready](https://badge.waffle.io/expectation-php/expect.png?label=ready&title=Ready)](https://waffle.io/expectation-php/expect)
[![Dependency Status](https://www.versioneye.com/user/projects/550f6a8da4c2d7527000010c/badge.svg?style=flat)](https://www.versioneye.com/user/projects/550f6a8da4c2d7527000010c)
[![Latest Stable Version](https://poser.pugx.org/expect/expect/v/stable.svg)](https://packagist.org/packages/expect/expect)
[![License](https://poser.pugx.org/expect/expect/license.svg)](https://packagist.org/packages/expect/expect)

Basic usage
------------------------

```php
use expect\Expect;
use expect\configurator\FileConfigurator;

$configurator = new FileConfigurator(__DIR__ . '/config.toml');
Expect::configure($configurator);

Expect::that(true)->toEqual(true); //pass
Expect::that(false)->toEqual(true); //failed
```

All of matcher
------------------------

### toEqual

```php
Expect::that(true)->toEqual(true); //pass
Expect::that(false)->toEqual(true); //failed
```

### toBeTrue

```php
Expect::that(true)->toBeTrue(); //pass
Expect::that(false)->toBeTrue(); //failed
```

### toBeFalse

```php
Expect::that(false)->toBeFalse(); //pass
Expect::that(true)->toBeFalse(); //failed
```

### toBeNull

```php
Expect::that(null)->toBeNull(); //pass
Expect::that(100)->toBeNull(); //failed
```

### toBeAnInstanceOf

```php
Expect::that(new ToEqual(true))->toBeAnInstanceOf('expect\Mathcer'); //pass
Expect::that(new stdClass)->toBeAnInstanceOf('expect\Mathcer'); //failed
```

### toBeAn / toBeA

```php
Expect::that(1)->toBeAn('integer'); //pass
Expect::that('foo')->toBeAn('integer'); //failed
Expect::that('foo')->toBeInteger(); //failed
```

```php
Expect::that('foo')->toBeAn('string'); //pass
Expect::that(1)->toBeAn('string'); //failed
Expect::that('foo')->toBeString(); //failed
```

```php
Expect::that(1.1)->toBeAn('float'); //pass
Expect::that('foo')->toBeAn('float'); //failed
Expect::that('foo')->toBeFloat(); //failed
```

```php
Expect::that(true)->toBeAn('boolean'); //pass
Expect::that('foo')->toBeAn('boolean'); //failed
Expect::that('foo')->toBeBoolean(); //failed
```

```php
Expect::that(1)->toBeA('integer'); //pass
Expect::that('foo')->toBeA('integer'); //failed
```

### toMatch

```php
Expect::that('foobar')->toMatch('/foo/'); //pass
Expect::that('foobar')->toMatch('/cat/'); //failed
```

### toStartWith

```php
Expect::that('foobar')->toStartWith('foo'); //pass
Expect::that('foobar')->toStartWith('cat'); //failed
```

### toEndWith

```php
Expect::that('foobar')->toEndWith('bar'); //pass
Expect::that('foobar')->toEndWith('cat'); //failed
```

### toHaveLength

```php
Expect::that('foobar')->toHaveLength(6); //pass
Expect::that('foobar')->toHaveLength(5); //failed
```

```php
Expect::that([ 1 ])->toHaveLength(1); //pass
Expect::that([ 1, 2 ])->toHaveLength(3); //failed
```

```php
Expect::that(new ArrayIterator([ 1 ]))->toHaveLength(1); //pass
Expect::that(new ArrayIterator([ 1, 2 ]))->toHaveLength(3); //failed
```

### toBeEmpty

```php
Expect::that([])->toBeEmpty(); //pass
Expect::that([ 1 ])->toBeEmpty(); //failed
```

### toPrint

```php
Expect::that(function () {
    echo 'foo';
})->toPrint('foo'); //pass

Expect::that(function () {
    echo 'bar';
})->toPrint('foo'); //failed
```

### toBeGreaterThan / toBeAbove

```php
Expect::that(11)->toBeGreaterThan(10); //pass
Expect::that(10)->toBeGreaterThan(10); //pass
Expect::that(9)->toBeGreaterThan(10); //failed
```

```php
Expect::that(11)->toBeAbove(10); //pass
Expect::that(10)->toBeAbove(10); //pass
Expect::that(9)->toBeAbove(10); //failed
```

### toBeLessThan / toBeBelow

```php
Expect::that(9)->toBeLessThan(10); //pass
Expect::that(10)->toBeLessThan(10); //failed
```

```php
Expect::that(9)->toBeBelow(10); //pass
Expect::that(10)->toBeBelow(10); //failed
```

### toBeWithin

```php
Expect::that(11)->toBeWithin(10, 20); //pass
Expect::that(9)->toBeWithin(10, 20); //failed
Expect::that(21)->toBeWithin(10, 20); //failed
```

### toContain

```php
Expect::that('foo')->toContain('foo'); //pass
Expect::that('foo')->toContain('foo', 'bar'); //failed
```

```php
Expect::that([ 'foo', 'bar' ])->toContain('foo'); //pass
Expect::that([ 'foo', 'bar' ])->toContain('foo', 'bar'); //pass
Expect::that([ 'foo', 'bar' ])->toContain('foo', 'bar', 'bar1'); //failed
```

### toHaveKey

```php
Expect::that([ 'foo' => 1 ])->toHaveKey('foo'); //pass
Expect::that([ 'foo' => 1 ])->toHaveKey('bar'); //failed
```

### ToBeTruthy

```php
Expect::that(true)->ToBeTruthy(); //pass
Expect::that('')->ToBeTruthy(); //pass
Expect::that(0)->ToBeTruthy(); //pass
Expect::that(false)->ToBeTruthy(); //failed
```

### ToBeFalsey

```php
Expect::that(false)->ToBeFalsey(); //pass
Expect::that(null)->ToBeFalsey(); //pass
Expect::that('')->ToBeFalsey(); //failed
Expect::that(0)->ToBeFalsey(); //failed
```
