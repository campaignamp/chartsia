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
     * @covers DataSet\DataSet::setData
     * @todo   Implement testSetData().
     */
    public function testSetData()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers DataSet\DataSet::getData
     * @todo   Implement testGetData().
     */
    public function testGetData()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers DataSet\DataSet::addData
     * @todo   Implement testAddData().
     */
    public function testAddData()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers DataSet\DataSet::setLegend
     * @todo   Implement testSetLegend().
     */
    public function testSetLegend()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers DataSet\DataSet::getLegend
     * @todo   Implement testGetLegend().
     */
    public function testGetLegend()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
