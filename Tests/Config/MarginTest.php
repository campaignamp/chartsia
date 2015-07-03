<?php

namespace Outspaced\GoogleChartMakerBundle\Tests\Config;

use \Outspaced\GoogleChartMakerBundle\Chart\Config\Margin;

class MarginTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::__construct
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::getLeft
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::getRight
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::getTop
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::getBottom
     */
    public function testConstructWithMargin()
    {
        $margin = new Margin(10, 20, 30, 40);
        $this->assertEquals($margin->getLeft(), 10);
        $this->assertEquals($margin->getRight(), 20);
        $this->assertEquals($margin->getTop(), 30);
        $this->assertEquals($margin->getBottom(), 40);
    }

    /**
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::__construct
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::setLeft
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::setRight
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::setTop
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::setBottom
     */
    public function testSetValues()
    {
        $margin = new Margin();

        $margin->setLeft(10);
        $margin->setRight(20);
        $margin->setTop(30);
        $margin->setBottom(40);

        $this->assertEquals($margin->getLeft(), 10);
        $this->assertEquals($margin->getRight(), 20);
        $this->assertEquals($margin->getTop(), 30);
        $this->assertEquals($margin->getBottom(), 40);
    }

    public function testGetDimensions()
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

    /**
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::setLegendHeight
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::getLegendHeight
     */
    public function testGetLegendHeight()
    {
        $margin = new Margin();
        $margin->setLegendHeight(50);
        $this->assertEquals(50, $margin->getLegendHeight());
    }

    /**
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::setLegendWidth
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Margin::getLegendWidth
     */
    public function testGetLegendWidth()
    {
        $margin = new Margin();
        $margin->setLegendWidth(50);
        $this->assertEquals(50, $margin->getLegendWidth());
    }
}
