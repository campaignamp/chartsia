<?php

namespace Outspaced\ChartsiaBundle\Tests\Chart\Renderer\Image;

use Outspaced\ChartsiaBundle\Chart\Charts;
use Outspaced\ChartsiaBundle\Chart\Component;
use Outspaced\ChartsiaBundle\Chart\Config;
use Outspaced\ChartsiaBundle\Chart\DataSet;
use Outspaced\ChartsiaBundle\Chart\Renderer;
use Outspaced\ChartsiaBundle\Chart\Type;
use Outspaced\ChartsiaBundle\Tests\Traits;

class PieChartImageRendererTest extends \PHPUnit_Framework_TestCase
{
    use Traits\AssertStringContainsOnce;

    /**
     * @var Image
     */
    protected $object;

    /**
     * @var string
     */
    protected $renderedChart;


    /**
     * Provide me pie!
     *
     * @return string[][]
     */
    public function providerPieChart()
    {
        $type = new Type\PieChart();

        $title = (new Config\Title())
            ->setTitle('Wahey what a chart')
            ->setColor(new Component\Color('00FF00'));

        $size = (new Config\Size())
            ->setHeight(300)
            ->setWidth(800);

        $margin = new Config\Margin(50, 80, 20, 100);

        $legend = (new Config\Legend())
            ->setPosition('up')
            ->setFontSize(23)
            ->setColor(new Component\Color('FFFF44'));

        $data = [
            "AB" => 63,
            "CD" => 72,
            "EF" => 91,
            "GH" => 84,
            "IJ" => 97
        ];

        $colorCollection = [
            new Component\Color('0000FF'),
            new Component\Color('00FF00'),
            new Component\Color('FF0000'),
            new Component\Color('FF00FF'),
            new Component\Color('FFFF00'),
        ];

        $dataSet = (new DataSet\DataSet())
            ->setData($data)
            ->setColorCollection($colorCollection)
            ->setLegend(new DataSet\Legend('Set 2'));

        $dataSetCollection = (new DataSet\DataSetCollection())
            ->add($dataSet);

        $chart = (new Charts\Chart())
            ->setType($type)
            ->setTitle($title)
            ->setSize($size)
            ->setMargin($margin)
            ->setLegend($legend)
            ->setDataSetCollection($dataSetCollection);

        $return = (new Renderer\Image())
            ->render($chart);

        return [[$return]];
    }

    /**
     */
    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(Renderer\Image::class, new Renderer\Image());
    }


    /**
     * @dataProvider providerPieChart
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testPieChartRenderContainsChartType($chart)
    {
        $this->assertStringContainsOnce(
            'cht=p',
            $chart
        );
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     * @dataProvider providerPieChart
     */
    public function testPieChartRenderContainsColorSet($chart)
    {
        $this->assertStringContainsOnce(
            'chco=0000FF|00FF00|FF0000|FF00FF|FFFF00',
            $chart
        );
    }
}
