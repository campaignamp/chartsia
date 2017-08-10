<?php

namespace Outspaced\ChartsiaBundle\Tests\DataSet;

use Outspaced\ChartsiaBundle\Chart\DataSet;

class DataSetTest extends \PHPUnit_Framework_TestCase
{
    use \Outspaced\ChartsiaBundle\Tests\Traits\ColorTestTrait;

    /**
     * @var DataSet\DataSet
     */
    protected $object;

    /**
     * @return DataSet\DataSet
     */
    protected function getObject()
    {
        return $this->object;
    }

    protected function setUp()
    {
        $this->object = new DataSet\DataSet;
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::setData
     * @covers Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::getData
     */
    public function testSetData()
    {
        $data = ['one', 'two', 'three'];

        $this->object->setData($data);

        $result = $this->object->getData($data);

        $this->assertEquals($data, $result);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::addData
     */
    public function testAddData()
    {
        $data = ['one', 'two', 'three'];

        $this->object->setData($data);

        $this->object->addData('four');

        $result = $this->object->getData($data);

        $expected = ['one', 'two', 'three', 'four'];

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::setColorCollection
     * @covers Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::getColorCollection
     */
    public function testSetColorCollection()
    {
        $data = ['red', 'white', 'blue'];

        $this->object->setColorCollection($data);

        $result = $this->object->getColorCollection();

        $this->assertEquals($data, $result);
    }


    /**
     * @covers Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::setLegend
     * @covers Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::getLegend
     */
    public function testSetLegend()
    {
        $legend = new DataSet\Legend();

        $this->object->setLegend($legend);

        $result = $this->object->getLegend();

        $this->assertEquals($legend, $result);
    }
}
