<?php

namespace Outspaced\ChartsiaBundle\Chart\Factory;

use Outspaced\ChartsiaBundle\Chart\Axis;
use Outspaced\ChartsiaBundle\Chart\Charts;
use Outspaced\ChartsiaBundle\Chart\Component;
use Outspaced\ChartsiaBundle\Chart\Config;
use Outspaced\ChartsiaBundle\Chart\DataSet;
use Outspaced\ChartsiaBundle\Chart\Type;

/**
 * Factory to make charts and the components, without having to manually create all the objects
 */
class ChartFactory
{
    /**
     * @var Type\Type
     */
    protected $type;

    /**
     * @var Component\Color
     */
    protected $defaultAxisColor;

    /**
     * @var Component\Color
     */
    protected $defaultColor;

    /**
     * @var Component\Color[]
     */
    protected $defaultColorCollection;

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
     * @var bool
     */
    protected $autoScale;

    /**
     * Type should probably go into the constructor
     *
     * @param  string $type
     * @return self
     */
    public function createType($type)
    {
        switch ($type) {
            case 'lc':
            case 'line_chart':
                $this->type = new Type\LineChart();
                break;
            case 'p':
            case 'pie_chart':
                $this->type = new Type\PieChart();
                break;
            case 'bhs':
            case 'bvg':
            case 'bar_chart':
                $this->type = new Type\BarChart();
                break;
        }

        $this->type
            ->setChartCode($type);

        return $this;
    }

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
     * @param string $colorName
     * @return ChartFactory
     */
    public function createDefaultAxisColor($colorName)
    {
        $this->defaultAxisColor = new Component\Color($colorName);

        return $this;
    }

    /**
     * @param  array $colorNames
     * @return ChartFactory
     */
    public function createDefaultColorCollection(array $colorNames)
    {
        $this->defaultColorCollection = [];

        foreach ($colorNames as $colorName) {
            $this->defaultColorCollection[] = new Component\Color($colorName);
        }

        return $this;
    }

    /**
     * @param string $title
     * @param string $titleColorName
     * @return ChartFactory
     */
    public function createTitle($title, $titleColorName)
    {
        $this->title = (new Config\Title())
            ->setTitle($title);

        if ($titleColorName) {
            $this->title->setColor(new Component\Color($titleColorName));
        } elseif ($this->defaultColor) {
            $this->title->setColor($this->defaultColor);
        }

        return $this;
    }

    /**
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
     * @param integer $left
     * @param integer $bottom
     * @param integer $right
     * @param integer $top
     * @return ChartFactory
     */
    public function createMargin($left, $bottom, $right, $top)
    {
        $this->margin = new Config\Margin($left, $right, $top, $bottom);

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
     * @param array $colorNames
     * @param string $legend
     * @return ChartFactory
     */
    public function addDataSet(array $data, array $colorNames = [], $legend = null)
    {
        $dataSet = new DataSet\DataSet();

        if (count($colorNames) == 1) {
            $dataSet->setColor(new Component\Color(current($colorNames)));
        } elseif (!empty($this->defaultColor)) {
            $dataSet->setColor($this->defaultColor);
        } elseif (!empty($this->defaultColorCollection)) {
            $dataSet->setColorCollection($this->defaultColorCollection);
        } else {

            $colorCollection = [];

            foreach ($colorNames as $colorName) {
                $colorCollection[] = new Component\Color($colorName);
            }

            $dataSet->setColorCollection($colorCollection);
        }

        if ($legend !== null) {
            $dataSet->setLegend(new DataSet\Legend($legend));
        }

        $dataSet->setData($data);

        $this->getDataSetCollection()
            ->add($dataSet);

        return $this;
    }

    /**
     * @param array $data
     * @param array $colorNames
     * @param string $legend
     * @return ChartFactory
     */
    public function addPrimaryDataSet(array $data, $colorNames = [], $legend = null)
    {
        // Bar charts default to bars running left-right
        if ($this->type->getSlug() == 'bar_chart' && $this->type->getChartCode() == 'bhs') {
            $this->createBottomAxis();

            // This needs improvement - it doesn't make much sense at the moment
            $this->bottomAxis->createTopValuePositionOnly(max($data));

            $this->autoScale = true;

            $this->createLeftAxis(array_keys($data), 1);
        } else {
            $this->createBottomAxis(array_keys($data), 1);
            $this->createLeftAxis();
        }

        return $this->addDataSet($data, $colorNames, $legend);
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

        if (empty($labels)) {
            $this->leftAxis->setAutoLabel(true);
        }

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

        if ($this->defaultAxisColor) {
            $axis->setColor($this->defaultAxisColor);
        }

        return $axis;
    }

    /**
     * @return Charts\Chart
     */
    public function getPreparedChart()
    {
        $chart = new Charts\Chart();

        foreach ($this as $key => $value) {

            // This sucks!
            if ($key == 'chart' || $key == 'defaultColor' || $key == 'defaultColorCollection' || $key == 'defaultAxisColor') {
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

    /**
     *
     * @param int $fontSize
     * @return self
     */
    public function setAxisFontSize($fontSize)
    {
        if ($this->topAxis) {
            $this->topAxis->setFontSize($fontSize);
        }

        if ($this->bottomAxis) {
            $this->bottomAxis->setFontSize($fontSize);
        }

        if ($this->leftAxis) {
            $this->leftAxis->setFontSize($fontSize);
        }

        if ($this->rightAxis) {
            $this->rightAxis->setFontSize($fontSize);
        }

        return $this;
    }
}
