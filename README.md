expect
========================

[![Build Status](https://travis-ci.org/expectation-php/expect.svg?branch=master)](https://travis-ci.org/expectation-php/expect)
[![HHVM Status](http://hhvm.h4cc.de/badge/expect/expect.svg)](http://hhvm.h4cc.de/package/expect/expect)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/expectation-php/expect/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/expectation-php/expect/?branch=master)
[![Coverage Status](https://coveralls.io/repos/expectation-php/expect/badge.svg)](https://coveralls.io/r/expectation-php/expect)
[![Stories in Ready](https://badge.waffle.io/expectation-php/expect.png?label=ready&title=Ready)](https://waffle.io/expectation-php/expect)
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
