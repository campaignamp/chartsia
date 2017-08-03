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
     * @var Component\Color
     */
    protected $defaultColor;

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
     * @param string $colorName
     * @return ChartFactory
     */
    public function createDefaultColor($colorName)
    {
        $this->defaultColor = new Component\Color($colorName);

        return $this;
    }

    /**
     * @param  string
     * @param  string
     * @param string $title
     * @param string $colorName
     * @return ChartFactory
     */
    public function createTitle($title, $colorName)
    {
        $this->title = (new Config\Title())
            ->setTitle($title);

        if ($colorName) {
            $this->title->setColor(new Component\Color($colorName));
        } elseif ($this->defaultColor) {
            $this->title->setColor($this->defaultColor);
        }

        return $this;
    }



    /**
     * @param  int
     * @param  int
     * @param integer $height
     * @param integer $width
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
     * @param integer $left
     * @param integer $bottom
     * @param integer $right
     * @param integer $top
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
            ->setFontSize($fontSize);

        if ($colorName) {
            $this->legend->setColor(new Component\Color($colorName));
        } elseif ($this->defaultColor) {
            $this->legend->setColor($this->defaultColor);
        }

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
        $dataSet = new DataSet\DataSet();

        if ($colorName) {
            $dataSet->setColor(new Component\Color($colorName));
        } elseif ($this->defaultColor) {
            $dataSet->setColor($this->defaultColor);
        }

        if ($legend !== null) {
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
     * @param array $data
     * @param string $colorName
     * @param string $legend
     * @return ChartFactory
     */
    public function addPrimaryDataSet(array $data, $colorName = null, $legend = null)
    {
        $this->createBottomAxis(array_keys($data), 1);

        return $this->addDataSet($data, $colorName, $legend);
    }

    /**
     * @return DataSet\DataSetCollection
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
     * @param integer $labelsStep
     * @param integer $gridlinesStepSize
     * @param integer $gridlinesOffset
     */
    public function createLeftAxis(array $labels = [], $labelsStep = 1, $gridlinesStepSize = 0, $gridlinesOffset = 0)
    {
        $this->leftAxis = $this->createAxis($labels, $labelsStep, $gridlinesStepSize, $gridlinesOffset);

        return $this;
    }

    /**
     * @param array $labels
     * @param integer $labelsStep
     * @param integer $gridlinesStepSize
     * @param integer $gridlinesOffset
     */
    public function createBottomAxis(array $labels = [], $labelsStep = 1, $gridlinesStepSize = 0, $gridlinesOffset = 0)
    {
        $this->bottomAxis = $this->createAxis($labels, $labelsStep, $gridlinesStepSize, $gridlinesOffset);

        return $this;
    }

    /**
     * @param  array $labels
     * @param  integer $labelsStep
     * @return ChartFactory
     */
    public function createTopAxis(array $labels = [], $labelsStep = 1)
    {
        $this->topAxis = $this->createAxis($labels, $labelsStep);

        return $this;
    }

    /**
     * @param  array $labels
     * @param  integer $labelsStep
     * @return ChartFactory
     */
    public function createRightAxis(array $labels = [], $labelsStep = 1)
    {
        $this->rightAxis = $this->createAxis($labels, $labelsStep);

        return $this;
    }

    /**
     * @param array $labels
     * @param integer $labelsStep
     * @param integer $gridlinesStepSize
     * @param integer $gridlinesOffset
     * @return Axis\Axis
     */
    public function createAxis(array $labels = [], $labelsStep = 1, $gridlinesStepSize = 0, $gridlinesOffset = 0)
    {
        $axis = new Axis\Axis();

        if (!empty($labels)) {
            $axis->createLabels($labels, $labelsStep);
        }

        if ($gridlinesStepSize || $gridlinesOffset) {
            $axis->setGridlines(new Axis\Gridlines($gridlinesStepSize, $gridlinesOffset));
        }

        return $axis;
    }

    /**
     * @return \Outspaced\ChartsiaBundle\Chart\Charts\LineChart
     */
    public function getPreparedChart()
    {
        $chart = new LineChart();

        foreach ($this as $key => $value) {
            if ($key == 'chart' || $key == 'defaultColor') {
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
