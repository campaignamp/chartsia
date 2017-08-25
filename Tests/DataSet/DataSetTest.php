<?php

namespace Outspaced\ChartsiaBundle\Tests\DataSet;

use Outspaced\ChartsiaBundle\Chart\DataSet;
use Outspaced\ChartsiaBundle\Chart\Component\Color;

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

        $result = $this->object->getData();

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

        $result = $this->object->getData();

        $expected = ['one', 'two', 'three', 'four'];

        $this->assertEquals($expected, $result);
    }

    /**
     * Thi
     *
     * @covers Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::setColorCollection
     * @covers Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::getColorCollection
     */
    public function testSetColorCollection()
    {
        $data = [
            new Color('red'),
            new Color('white'),
            new Color('blue')
        ];

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
