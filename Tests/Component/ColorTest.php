<?php

namespace Outspaced\GoogleChartMakerBundle\Tests\Component;

use \Outspaced\GoogleChartMakerBundle\Chart\Component\Color;

class ColorTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructWithColor()
    {
        $color = new Color('FF0000');

        $this->assertEquals($color->getColor(), 'FF0000');
    }

    public function testSetColor()
    {
        $color = new Color();
        $color->setColor('FF0000');

        $this->assertEquals($color->getColor(), 'FF0000');
    }

}