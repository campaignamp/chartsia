<?php

namespace Outspaced\ChartsiaBundle\Tests\Chart\Factory;

use Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory;

class ChartFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ChartFactory
     */
    protected $object;

    /**
     */
    protected function setUp()
    {
        $this->object = new ChartFactory();
    }

    /**
     */
    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(ChartFactory::class, $this->object);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::createTitle
     */
    public function testCreateTitle()
    {
        $return = $this->object->createTitle('hello', 'blue');

        $this->assertEquals($this->object, $return);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::createSize
     */
    public function testCreateSize()
    {
        $return = $this->object->createSize(300, 800);

        $this->assertEquals($this->object, $return);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::createMargin
     */
    public function testCreateMargin()
    {
        $return = $this->object->createMargin(1, 2, 3, 4);

        $this->assertEquals($this->object, $return);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::createLegend
     */
    public function testCreateLegend()
    {
        $return = $this->object->createLegend('blue', 1, 2);

        $this->assertEquals($this->object, $return);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::createLeftAxis
     */
    public function testCreateLeftAxis()
    {
        $return = $this->object->createLeftAxis();

        $this->assertEquals($this->object, $return);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::createBottomAxis
     */
    public function testCreateBottomAxis()
    {
        $return = $this->object->createBottomAxis();

        $this->assertEquals($this->object, $return);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::createRightAxis
     */
    public function testCreateRightAxis()
    {
        $return = $this->object->createRightAxis();

        $this->assertEquals($this->object, $return);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::createTopAxis
     */
    public function testCreateTopAxis()
    {
        $return = $this->object->createTopAxis();

        $this->assertEquals($this->object, $return);
    }

}
