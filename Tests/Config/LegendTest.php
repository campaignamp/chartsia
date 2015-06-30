<?php

namespace Outspaced\GoogleChartMakerBundle\Tests\Config;

use \Outspaced\GoogleChartMakerBundle\Chart\Config\Legend;

class LegendTest extends \PHPUnit_Framework_TestCase
{
    public function testSetPosition()
    {
        $legend = new Legend();
        $legend->setPosition('ip');
        $this->assertEquals($legend->getPosition(), 'ip');
    }

    public function testSetFontSize()
    {
        $legend = new Legend();
        $legend->setFontSize(14);
        $this->assertEquals($legend->getFontSize(), 14);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetNonIntFontSize()
    {
        $legend = new Legend();
        $legend->setFontSize('whoop');
    }
}
