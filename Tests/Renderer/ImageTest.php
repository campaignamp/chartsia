<?php

namespace Outspaced\ChartsiaBundle\Tests\Chart\Renderer;

use Outspaced\ChartsiaBundle\Chart\Renderer\Image;
use Outspaced\ChartsiaBundle\Chart\Component;
use Outspaced\ChartsiaBundle\Chart\Charts;
use Outspaced\ChartsiaBundle\Chart\Config;
use Outspaced\ChartsiaBundle\Chart\DataSet;
use Outspaced\ChartsiaBundle\Chart\Renderer;
use Outspaced\ChartsiaBundle\Chart\Axis;

class ImageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Image
     */
    protected $object;

    /**
     * @var string
     */
    protected $renderedChart;

    /**
     */
    protected function setUp()
    {
        $this->object = new Image();

        $title = (new Config\Title())
//        $title->setTitle('Wahey what a chart')
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
            "02/04" => 63,
            "09/04" => 72,
            "16/04" => 91,
            "04/06" => 84,
            "11/06" => 97
        ];

        $dataSet = (new DataSet\DataSet())
            ->setData($data)
            ->setColor(new Component\Color('0000FF'))
            ->setLegend(new DataSet\Legend('Set 2'));

        $dataSetCollection = (new DataSet\DataSetCollection())
            ->add($dataSet);

        $bottomAxis = (new Axis\Axis())
            ->createLabels(array_keys($data), 1);

        $leftAxis = (new Axis\Axis())
//            ->setTitle(new Axis\Title('HELLO!', 30))
            ->setGridlines(new Axis\Gridlines(20));

        $chart = (new Charts\LineChart())
            ->setTitle($title)
            ->setSize($size)
            ->setMargin($margin)
            ->setLegend($legend)
            ->setDataSetCollection($dataSetCollection)
            ->setLeftAxis($leftAxis)
            ->setBottomAxis($bottomAxis);

        $renderer = new Renderer\Image();

        $this->renderedChart = $renderer->render($chart);

    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::__construct
     */
    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(Image::class, $this->object);
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testRenderContainsUrl()
    {
        $this->assertContains(
            'http://chart.googleapis.com/chart',
            $this->renderedChart
        );
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testRenderContainsChartDefinition()
    {
        $this->assertContains(
            'cht=lc',
            $this->renderedChart
        );
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testRenderContainsChartSize()
    {
        $this->assertContains(
            'chs=800x300',
            $this->renderedChart
        );
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testRenderContainsMargins()
    {
        $this->assertContains(
            'chma=50,80,20,100',
            $this->renderedChart
        );
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testRenderContainsLegend()
    {
        $this->assertContains(
            'chdls=FFFF44,23',
            $this->renderedChart
        );
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testRenderContainsTitle()
    {
        // Currently has no title
        $this->assertContains(
            'chts=00FF00&',
            $this->renderedChart
        );
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testRenderContainsAxes()
    {
        $this->assertContains(
            'chxt=x,y',
            $this->renderedChart
        );
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testRenderContainsAxisLabels()
    {
        $this->assertContains(
            'chxl=0:|02/04|09/04|16/04|04/06|11/06|',
            $this->renderedChart
        );
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testRenderContainsAxisPositions()
    {
        $this->assertContains(
            'chxp=0,,,,,',
            $this->renderedChart
        );
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testRenderContainsGridlines()
    {
        $this->assertContains(
            'chg=0,20,0,0,0,0',
            $this->renderedChart
        );
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testRenderContainsDataSet()
    {
        $this->assertContains(
            'chd=t:63,72,91,84,97',
            $this->renderedChart
        );
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testRenderContainsLineColours()
    {
        $this->assertContains(
            'chco=0000FF',
            $this->renderedChart
        );
    }

    /**
     * @covers Outspaced\ChartsiaBundle\Chart\Renderer\Image::render
     */
    public function testRenderContainsDataSetLabel()
    {
        $this->assertContains(
            'chdl=Set+2',
            $this->renderedChart
        );
    }
}
