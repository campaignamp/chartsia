<?php

namespace Outspaced\GoogleChartMakerBundle\Tests\Config;

use Outspaced\GoogleChartMakerBundle\Chart\Config;
use Outspaced\GoogleChartMakerBundle\Chart\Component;

class LegendTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Config\Legend::setPostion
     * @covers Config\Legend::getPostion
     */
    public function testSetPosition()
    {
        $legend = new Config\Legend();
        $legend->setPosition('ip');
        $this->assertEquals($legend->getPosition(), 'ip');
    }

    /**
     * @covers Config\Legend::setFontSize
     * @covers Config\Legend::getFontSize
     */
    public function testSetFontSize()
    {
        $legend = new Config\Legend();
        $legend->setFontSize(14);
        $this->assertEquals($legend->getFontSize(), 14);
    }

    /**
     * @covers Config\Legend::setSetColor
     * @covers Config\Legend::getSetColor
     */
    public function testSetColor()
    {
        $color = new Component\Color();
        $legend = new Config\Legend();
        $legend->setColor($color);

        $this->assertInstanceOf('\Outspaced\GoogleChartMakerBundle\Chart\Component\Color', $legend->getColor());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetNonIntFontSize()
    {
        $legend = new Config\Legend();
        $legend->setFontSize('whoop');
    }
}
