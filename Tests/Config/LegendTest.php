<?php

namespace Outspaced\ChartsiaBundle\Tests\Config;

use Outspaced\ChartsiaBundle\Chart\Config;
use Outspaced\ChartsiaBundle\Chart\Component;

class LegendTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Legend::setPosition
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Legend::getPosition
     */
    public function testSetPosition()
    {
        $legend = new Config\Legend();
        $legend->setPosition('ip');
        $this->assertEquals($legend->getPosition(), 'ip');
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Legend::setFontSize
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Legend::getFontSize
     */
    public function testSetFontSize()
    {
        $legend = new Config\Legend();
        $legend->setFontSize(14);
        $this->assertEquals($legend->getFontSize(), 14);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Legend::setColor
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Legend::getColor
     */
    public function testSetColor()
    {
        $color = new Component\Color();
        $legend = new Config\Legend();
        $legend->setColor($color);

        $this->assertInstanceOf('\Outspaced\ChartsiaBundle\Chart\Component\Color', $legend->getColor());
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
