<?php

namespace Outspaced\ChartsiaBundle\Tests\Traits;

use Outspaced\ChartsiaBundle\Chart\Component\Color;

trait ColorTestTrait
{
    /**
     * Trait extension approximation
     */
    use BaseTestTrait;

    public function testSetColor()
    {
        $color = new Color;

        $returned = $this->getObject()->setColor($color);

        $this->assertInstanceOf(get_class($this->object), $returned);
    }

    public function testGetColor()
    {
        $color = new Color;

        $this->getObject()->setColor($color);

        $this->assertEquals($color, $this->object->getColor());
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testSetColorWithNotAColor()
    {
        $this->getObject()->setColor('I am no object!');
    }
}
