<?php

namespace Outspaced\GoogleChartMakerBundle\Tests\Traits;

use Outspaced\GoogleChartMakerBundle\Chart\Component\Color;

trait ColorTestTrait
{
    public function testSetColor()
    {
        $color = new Color;

        $returned = $this->object->setColor($color);

        $this->assertInstanceOf(get_class($this->object), $returned);
    }

    public function testGetColor()
    {
        $color = new Color;

        $this->object->setColor($color);

        $this->assertEquals($color, $this->object->getColor());
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testSetColorWithNotAColor()
    {
        $this->object->setColor('I am no object!');
    }
}
