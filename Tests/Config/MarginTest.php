<?php

namespace Outspaced\GoogleChartMakerBundle\Tests\Config;

use \Outspaced\GoogleChartMakerBundle\Chart\Config\Margin;

class MarginTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructWithMargin()
    {
        $margin = new Margin(10, 20, 30, 40);
        $this->assertEquals($margin->getLeft(), 10);
        $this->assertEquals($margin->getRight(), 20);
        $this->assertEquals($margin->getTop(), 30);
        $this->assertEquals($margin->getBottom(), 40);
    }

    public function testSetValues()
    {
        $margin = new Margin(10, 20, 30, 40);

        $margin->getLeft(10);
        $margin->getRight(20);
        $margin->getTop(30);
        $margin->getBottom(40);

        $this->assertEquals($margin->getLeft(), 10);
        $this->assertEquals($margin->getRight(), 20);
        $this->assertEquals($margin->getTop(), 30);
        $this->assertEquals($margin->getBottom(), 40);
    }

    public function testGetAllValues()
    {
        $margin = new Margin(10, 20, 30, 40);
        $this->assertEquals($margin->getDimensions(), [10, 20, 30, 40]);
    }

    public function testGetAllValuesWithOptionalValues()
    {
        $margin = new Margin(10, 20, 30, 40);
        $margin->setLegendHeight(50);
        $margin->setLegendWidth(60);

        $this->assertEquals($margin->getDimensions(), [10, 20, 30, 40, 50, 60]);
    }
}
