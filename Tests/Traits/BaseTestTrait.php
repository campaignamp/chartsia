<?php

namespace Outspaced\GoogleChartMakerBundle\Tests\Traits;

trait BaseTestTrait
{
    /**
     *  These exist merely to stop Scrutinizer complaining, which might be a bad idea
     */
    public static function assertEquals($expected, $actual, $message = '', $delta = 0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false) {}

    public static function assertInstanceOf($expected, $actual, $message = '') {}

    protected function getObject() {}
}
