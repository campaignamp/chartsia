<?php

namespace Outspaced\ChartsiaBundle\Tests\Chart\Config;

use Outspaced\ChartsiaBundle\Chart\Config\Type;

use Outspaced\ChartsiaBundle\Chart\Config;

class TypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Type
     */
    protected $object;

    /**
     */
    protected function setUp()
    {
        $this->object = new Type();
    }

    /**
     * @covers Type::__construct
     */
    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(Type::class, $this->object);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Type::setType
     * @covers Outspaced\ChartsiaBundle\Chart\Config\Type::getType
     */
    public function testSetType()
    {
        $value = "I am a string";

        $this->object->setType($value);

        $this->assertEquals($value, $this->object->getType());
    }

}
