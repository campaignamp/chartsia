<?php

namespace Outspaced\ChartsiaBundle\Tests\Config;

use \Outspaced\ChartsiaBundle\Chart\Config\Margin;

class MarginTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->margin = new Margin(10, 20, 30, 40);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::__construct
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::getLeft
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::getRight
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::getTop
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::getBottom
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
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::__construct
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::setLeft
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::setRight
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::setTop
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::setBottom
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
        $this->margin->setLegendHeight(50);
        $this->margin->setLegendWidth(60);

        $this->assertEquals($this->margin->getDimensions(), [10, 20, 30, 40, 50, 60]);
    }

    public function testGetAllValuesWithLegendWidthButNoLegendHeight()
    {
        $this->margin->setLegendWidth(75);

        $this->assertEquals($this->margin->getDimensions(), [10, 20, 30, 40, NULL, 75]);
    }


    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::setLegendHeight
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::getLegendHeight
     */
    public function testGetLegendHeight()
    {
        $margin = new Margin();
        $margin->setLegendHeight(50);
        $this->assertEquals(50, $margin->getLegendHeight());
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::setLegendWidth
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Margin::getLegendWidth
     */
    public function testGetLegendWidth()
    {
        $margin = new Margin();
        $margin->setLegendWidth(50);
        $this->assertEquals(50, $margin->getLegendWidth());
    }
}
