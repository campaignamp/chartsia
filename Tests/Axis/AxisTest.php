<?php
namespace Outspaced\ChartsiaBundle\Tests\Axis;

use Outspaced\ChartsiaBundle\Chart\Axis;

/**
 */
class AxisTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Axis\Axis
     */
    protected $object;

    /**
     */
    protected function setUp()
    {
        $this->object = new Axis\Axis;
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Axis\Axis::getLabels
     * @covers Outspaced\ChartsiaBundle\Chart\Axis\Axis::addLabel
     * @todo   Implement testGetLabel().
     */
    public function testGetLabel()
    {
        $label = new Axis\Label('Hi', 12);

        $this->object->addLabel($label);

        $labels = $this->object->getLabels();

        $this->assertEquals($label, $labels[0]);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Axis\Axis::createLabels
     */
    public function testCreateLabels()
    {
        $labelData = [
            '2017-01-01',
            '2017-01-02',
            '2017-01-03',
            '2017-01-04',
        ];

        $this->object->createLabels($labelData, 2);

        $labels = $this->object->getLabels();

        $expected = [
            new Axis\Label('2017-01-01'),
            new Axis\Label(''),
            new Axis\Label('2017-01-03'),
            new Axis\Label(''),
        ];

        $this->assertEquals($expected, $labels);
    }
}
