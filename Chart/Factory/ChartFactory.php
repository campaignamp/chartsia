<?php

namespace Outspaced\ChartsiaBundle\Chart\Factory;

use Outspaced\ChartsiaBundle\Chart\Axis;
use Outspaced\ChartsiaBundle\Chart\Charts\LineChart;
use Outspaced\ChartsiaBundle\Chart\Charts;
use Outspaced\ChartsiaBundle\Chart\Component;
use Outspaced\ChartsiaBundle\Chart\Config;
use Outspaced\ChartsiaBundle\Chart\DataSet;

/**
 * Factory to make charts and the components, without having to manually create all the objects
 */
class ChartFactory
{
    /**
     * @var Charts\Chart
     */
    protected $chart;

    /**
     * @var Config\Title
     */
    protected $title;

    /**
     * @var Config\Size
     */
    protected $size;

    /**
     * @var Config\Margin
     */
    protected $margin;

    /**
     * @var Config\Legend
     */
    protected $legend;

    /**
     * @var DataSet\DataSetCollection
     */
    protected $dataSetCollection;

    /**
     * @var Axis\Axis
     */
    protected $leftAxis;

    /**
     * @var Axis\Axis
     */
    protected $bottomAxis;

    /**
     * @var Axis\Axis
     */
    protected $rightAxis;

    /**
     * @var Axis\Axis
     */
    protected $topAxis;

    /**
     * Right now it's only a line chart
     */
    public function __construct()
    {
        $this->chart = new LineChart();
    }

    /**
     * @param  string
     * @param  string
     * @return ChartFactory
     */
    public function createTitle($title, $colorName)
    {
        $this->title = (new Config\Title())
            ->setTitle($title);

        if ($colorName) {
            $this->title->setColor(new Component\Color('00FF00'));
        }

        return $this;
    }
    /**
     * @param  int
     * @param  int
     * @return ChartFactory
     */
    public function createSize($height, $width)
    {
        $this->size = (new Config\Size())
            ->setHeight($height)
            ->setWidth($width);

        return $this;
    }

    /**
     * @param  int
     * @param  int
     * @param  int
     * @param  int
     * @return ChartFactory
     */
    public function createMargin($left, $bottom, $right, $top)
    {
        $this->margin = new Config\Margin($left, $bottom, $right, $top);

        return $this;
    }

    /**
     * @param string $colorName
     * @param int $fontSize
     * @param int $position
     * @return ChartFactory
     */
    public function createLegend($colorName, $fontSize, $position)
    {
        $this->legend = (new Config\Legend())
            ->setPosition($position)
            ->setFontSize($fontSize)
            ->setColor(new Component\Color($colorName));

        return $this;
    }

    /**
     * @param array $data
     * @param string $colorName
     * @param string $legend
     * @return ChartFactory
     */
    public function addDataSet(array $data, $colorName, $legend = null)
    {
        $dataSet = (new DataSet\DataSet())
            ->setColor(new Component\Color($colorName));

        if ($legend) {
            $dataSet->setLegend(new DataSet\Legend($legend));
        }

        foreach ($data as $item) {
            $dataSet->addData($item);
        }

        $this->getDataSetCollection()
            ->add($dataSet);

        return $this;
    }


    /**
     * @return ChartFactory
     */
    public function getDataSetCollection()
    {
        if (!$this->dataSetCollection) {
            $this->dataSetCollection = new DataSet\DataSetCollection();
        }

        return $this->dataSetCollection;
    }

    /**
     * @param array $labels
     * @param number $labelsStep
     * @param number $gridlinesStepSize
     * @param number $gridlinesOffset
     */
    public function createLeftAxis(array $labels = [], $labelsStep = 1, $gridlinesStepSize = 0, $gridlinesOffset = 0)
    {
        $axis = new Axis\Axis();

        if ($labels) {
            $axis->createLabels($labels, $labelsStep);
        }

        if ($gridlinesStepSize || $gridlinesOffset) {
            $axis->setGridlines(new Axis\Gridlines($gridlinesStepSize, $gridlinesOffset));
        }

        $this->leftAxis = $axis;

        return $this;
    }

    /**
     * @param array $labels
     * @param number $labelsStep
     * @param number $gridlinesStepSize
     * @param number $gridlinesOffset
     */
    public function createBottomAxis(array $labels = [], $labelsStep = 1, $gridlinesStepSize = 0, $gridlinesOffset = 0)
    {
        $axis = new Axis\Axis();

        if ($labels) {
            $axis->createLabels($labels, $labelsStep);
        }

        if ($gridlinesStepSize || $gridlinesOffset) {
            $axis->setGridlines(new Axis\Gridlines($gridlinesStepSize, $gridlinesOffset));
        }

        $this->bottomAxis = $axis;

        return $this;
    }

    /**
     * @param  array $labels
     * @param  number $labelsStep
     * @return ChartFactory
     */
    public function createTopAxis(array $labels = [], $labelsStep = 1)
    {
        $axis = new Axis\Axis();

        if ($labels) {
            $axis->createLabels($labels, $labelsStep);
        }

        $this->topAxis = $axis;

        return $this;
    }

    /**
     * @param  array $labels
     * @param  number $labelsStep
     * @return ChartFactory
     */
    public function createRightAxis(array $labels = [], $labelsStep = 1)
    {
        $axis = new Axis\Axis();

        if ($labels) {
            $axis->createLabels($labels, $labelsStep);
        }

        $this->rightAxis = $axis;

        return $this;
    }

    public function getPreparedChart()
    {
        $chart = new LineChart();

        foreach ($this as $key => $value) {
            if ($key == 'chart') {
                continue;
            }

            if (!$value) {
                continue;
            }

            $setMethod = 'set' . ucwords($key);

            $chart->{$setMethod}($value);
        }

        return $chart;
    }
}
