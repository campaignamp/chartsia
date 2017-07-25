<?php

namespace Outspaced\ChartsiaBundle\Tests\Chart\Axis;

use Outspaced\ChartsiaBundle\Chart\Axis\Label;

use Outspaced\ChartsiaBundle\Chart\Axis;

class LabelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Label
     */
    protected $object;

    /**
     */
    protected function setUp()
    {
        $label = "I am a string";

        $position = 42;

        $this->object = new Label($label, $position);
    }

    /**
     * @covers Label::__construct
     */
    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(Label::class, $this->object);
    }
}
