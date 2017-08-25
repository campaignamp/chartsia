<?php

namespace Outspaced\ChartsiaBundle\Tests\Traits;

trait AssertStringContainsOnce
{
    /**
     * @param string $needle
     * @param string $haystack
     * @throws \PHPUnit_Framework_ExpectationFailedException
     */
    protected function assertStringContainsOnce($needle, $haystack)
    {
        $needle = preg_quote($needle, '/');

        if (!preg_match_all('/(' . $needle . ')/', $haystack, $matches)) {
            throw new \PHPUnit_Framework_ExpectationFailedException(
                'String ' . $haystack . ' does not contain ' . $needle
            );
        }

        $count = count($matches[1]);

        if ($count != 1) {
            throw new \PHPUnit_Framework_ExpectationFailedException(
                'String ' . $haystack . ' contains ' . $needle . ' more than once: ' . $count . ' times'
            );
        }
    }
}
