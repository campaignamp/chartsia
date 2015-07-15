<?php

namespace Outspaced\ChartsiaBundle\Tests\Config;

use \Outspaced\ChartsiaBundle\Chart\Config\Size;

class SizeTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructWithSize()
    {
        $size = new Size(300, 500);
        $this->assertEquals($size->getHeight(), 300);
        $this->assertEquals($size->getWidth(), 500);
    }

    public function testSetValues()
    {
        $size = new Size();
        $size->setHeight(300);
        $size->setWidth(500);
        $this->assertEquals($size->getHeight(), 300);
        $this->assertEquals($size->getWidth(), 500);
    }

    public function testGetDimensions()
    {
        $size = new Size();
        $size->setHeight(300);
        $size->setWidth(500);
        $this->assertEquals($size->getDimensions(), [500, 300]);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructWithNonIntSize()
    {
        new Size('a', 'b');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetNonIntHeight()
    {
        $size = new Size();
        $size->setHeight(45.6);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetNonIntWidth()
    {
        $size = new Size();
        $size->setWidth(NULL);
    }
}
