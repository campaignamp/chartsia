<?php

namespace Outspaced\ChartsiaBundle\Tests\DataSet;

use \Outspaced\ChartsiaBundle\Chart\DataSet\Legend;

class LegendTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructWithLabel()
    {
        $legend = new Legend('Yes! I am a long way from home');

        $this->assertEquals($legend->getLabel(), 'Yes! I am a long way from home');
    }

    public function testSetLabel()
    {
        $legend = new Legend();
        $legend->setLabel('Yes! I am a long way from home');

        $this->assertEquals($legend->getLabel(), 'Yes! I am a long way from home');
    }

}