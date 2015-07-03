<?php

namespace Outspaced\GoogleChartMakerBundle\Tests\Config;

use \Outspaced\GoogleChartMakerBundle\Chart\Config\Title;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-07-03 at 21:46:30.
 */
class TitleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Title
     */
    protected $object;

    /**
     */
    protected function setUp()
    {
        $this->object = new Title;
    }

    /**
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Title::setTitle
     */
    public function testSetTitle()
    {
        $this->object->setTitle('Hello. Is it me you\'re looking for?');
    }

    /**
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Title::getTitle
     * @todo   Implement testGetTitle().
     */
    public function testGetTitle()
    {
        $this->object->setTitle('Hello. Is it me you\'re looking for?');
        $this->assertEquals('Hello. Is it me you\'re looking for?', $this->object->getTitle());
    }

    /**
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Title::setColor
     * @todo   Implement testSetColor().
     */
    public function testSetColor()
    {
        $color = new \Outspaced\GoogleChartMakerBundle\Chart\Component\Color();
        $this->object->setColor($color);
    }

    /**
     * @covers Outspaced\GoogleChartMakerBundle\Chart\Config\Title::getColor
     * @todo   Implement testGetColor().
     */
    public function testGetColor()
    {
        $color = new \Outspaced\GoogleChartMakerBundle\Chart\Component\Color();
        $this->object->setColor($color);

        $this->assertInstanceOf('\Outspaced\GoogleChartMakerBundle\Chart\Component\Color', $this->object->getColor());
    }
}
