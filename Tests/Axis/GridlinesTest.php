<?php

namespace Outspaced\ChartsiaBundle\Tests\Chart\Axis;

use Outspaced\ChartsiaBundle\Chart\Axis\Gridlines;
use Outspaced\ChartsiaBundle\Chart\Axis;

class GridlinesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Gridlines
     */
    protected $object;

    /**
     */
    protected function setUp()
    {
        $this->object = new Gridlines();
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Axis\Gridlines::__construct
     */
    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(Gridlines::class, $this->object);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Axis\Gridlines::setStepSize
     * @covers Outspaced\ChartsiaBundle\Chart\Axis\Gridlines::getStepSize
     */
    public function testSetStepSize()
    {
        $value = 42;

        $this->object->setStepSize($value);

        $this->assertEquals($value, $this->object->getStepSize());
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Axis\Gridlines::setOffset
     * @covers Outspaced\ChartsiaBundle\Chart\Axis\Gridlines::getOffset
     */
    public function testSetOffset()
    {
        $value = 42;

        $this->object->setOffset($value);

        $this->assertEquals($value, $this->object->getOffset());
    }

}
