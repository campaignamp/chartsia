<?php

namespace Outspaced\ChartsiaBundle\Tests\Chart\Factory;

use Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory;

use Outspaced\ChartsiaBundle\Chart\Factory;
use Outspaced\ChartsiaBundle\Chart\Config;
use Outspaced\ChartsiaBundle\Chart\DataSet;
use Outspaced\ChartsiaBundle\Chart\Config\Axis;

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
     * @covers ChartFactory::__construct
     */
    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(ChartFactory::class, $this->object);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::setTitle
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::getTitle
     */
    public function testSetTitle()
    {
        $value = $this
            ->getMockBuilder('Outspaced\ChartsiaBundle\Chart\Config\Title')
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setTitle($value);

        $this->assertEquals($value, $this->object->getTitle());
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::setSize
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::getSize
     */
    public function testSetSize()
    {
        $value = $this
            ->getMockBuilder('Outspaced\ChartsiaBundle\Chart\Config\Size')
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setSize($value);

        $this->assertEquals($value, $this->object->getSize());
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::setMargin
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::getMargin
     */
    public function testSetMargin()
    {
        $value = $this
            ->getMockBuilder('Outspaced\ChartsiaBundle\Chart\Config\Margin')
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setMargin($value);

        $this->assertEquals($value, $this->object->getMargin());
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::setLegend
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::getLegend
     */
    public function testSetLegend()
    {
        $value = $this
            ->getMockBuilder('Outspaced\ChartsiaBundle\Chart\Config\Legend')
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setLegend($value);

        $this->assertEquals($value, $this->object->getLegend());
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::setDataSetCollection
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::getDataSetCollection
     */
    public function testSetDataSetCollection()
    {
        $value = $this
            ->getMockBuilder('Outspaced\ChartsiaBundle\Chart\DataSet\DataSetCollection')
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setDataSetCollection($value);

        $this->assertEquals($value, $this->object->getDataSetCollection());
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::setLeftAxis
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::getLeftAxis
     */
    public function testSetLeftAxis()
    {
        $value = $this
            ->getMockBuilder('Outspaced\ChartsiaBundle\Chart\Config\Axis\Axis')
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setLeftAxis($value);

        $this->assertEquals($value, $this->object->getLeftAxis());
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::setBottomAxis
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::getBottomAxis
     */
    public function testSetBottomAxis()
    {
        $value = $this
            ->getMockBuilder('Outspaced\ChartsiaBundle\Chart\Config\Axis\Axis')
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setBottomAxis($value);

        $this->assertEquals($value, $this->object->getBottomAxis());
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::setRightAxis
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::getRightAxis
     */
    public function testSetRightAxis()
    {
        $value = $this
            ->getMockBuilder('Outspaced\ChartsiaBundle\Chart\Config\Axis\Axis')
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setRightAxis($value);

        $this->assertEquals($value, $this->object->getRightAxis());
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::setTopAxis
     * @covers Outspaced\ChartsiaBundle\Chart\Factory\ChartFactory::getTopAxis
     */
    public function testSetTopAxis()
    {
        $value = $this
            ->getMockBuilder('Outspaced\ChartsiaBundle\Chart\Config\Axis\Axis')
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setTopAxis($value);

        $this->assertEquals($value, $this->object->getTopAxis());
    }

}
