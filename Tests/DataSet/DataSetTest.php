<?php
namespace Outspaced\ChartsiaBundle\Tests\DataSet;

class DataSetTest extends \PHPUnit_Framework_TestCase
{
    use \Outspaced\ChartsiaBundle\Tests\Traits\ColorTestTrait;

    /**
     * @var \Outspaced\ChartsiaBundle\Chart\DataSet\DataSet
     */
    protected $object;

    /**
     * @return \Outspaced\ChartsiaBundle\Chart\DataSet\DataSet
     */
    protected function getObject()
    {
        return $this->object;
    }

    protected function setUp()
    {
        $this->object = new \Outspaced\ChartsiaBundle\Chart\DataSet\DataSet;
    }

    /**
     * @covers \Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::setData
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
     * @covers \Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::getData
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
     * @covers \Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::addData
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
     * @covers \Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::setLegend
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
     * @covers \Outspaced\ChartsiaBundle\Chart\DataSet\DataSet::getLegend
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
