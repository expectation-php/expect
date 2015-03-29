<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expect;

use ArrayIterator;
use expect\package\MatcherClass;
use expect\package\ReflectionIterator;
use Collections\Dictionary;


/**
 * Matcher package
 *
 * @package expect
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 * @copyright Noritaka Horio <holy.shared.design@gmail.com>
 */
class MatcherPackage implements RegisterablePackage
{
    const MATCHER = '\expect\matcher\ReportableMatcher';

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $namespaceDirectory;

    /**
     * Create a new macther package
     *
     * @param string $namespace namespace of package
     * @param string $namespaceDirectory directory of package
     */
    public function __construct($namespace, $namespaceDirectory)
    {
        $this->namespace = $namespace;
        $this->namespaceDirectory = $namespaceDirectory;
    }

    /**
     * {@inheritdoc}
     */
    public function registerTo(MatcherRegistry $registry)
    {
        $provideMatchers = $this->getProvideMatchers();

        foreach ($provideMatchers as $provideMatcher) {
            $registry->register($provideMatcher);
        }
    }

    /**
     * @return ArrayIterator
     */
    private function getProvideMatchers()
    {
        $matchers = [];
        $reflectionIterator = new ReflectionIterator(
            $this->namespace,
            $this->namespaceDirectory
        );

        foreach ($reflectionIterator as $reflection) {
            if ($reflection->implementsInterface(static::MATCHER) === false) {
                continue;
            }

            $matchers[] = new MatcherClass(
                $reflection->getNamespaceName(),
                $reflection->getShortName()
            );
        }

        return new ArrayIterator($matchers);
    }

    /**
     * Create a new matcher package from composer.json
     *
     * @param string $composerJson composer.json path
     */
    public static function fromPackageFile($composerJson)
    {
        $composerJsonDirectory = dirname($composerJson);

        $content = file_get_contents($composerJson);
        $jsonValue = json_decode($content, true);

        $json = Dictionary::fromArray($jsonValue);
        $autoload = $json->get('autoload');

        $psr4 = $autoload->get('psr-4');
        $psr4Pair = array_shift( $psr4->values() );

        $namespace = $psr4Pair->first;
        $namespaceDirectory = realpath($composerJsonDirectory . '/' . $psr4Pair->second);

        if (substr($namespace, strlen($namespace) - 1) === '\\') {
            $namespace = substr($namespace, 0, strlen($namespace) - 1);
        }

        return new self($namespace, $namespaceDirectory);
    }

}
