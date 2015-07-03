<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\Charts;

use Outspaced\GoogleChartMakerBundle\Chart\Element;
use Outspaced\GoogleChartMakerBundle\Chart\Config;
use Outspaced\GoogleChartMakerBundle\Chart\DataSet;

abstract class BaseChart
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $elements = [];

    /**
     * @var array
     */
    protected $dataSets = [];

    /**
     * @var Title
     */
    protected $title;

    /**
     * @var Size
     */
    protected $size;

    /**
     * @var Margin
     */
    protected $margin;

    /**
     * @var Legend
     */
    protected $legend;

    /**
     * @param  Element\ElementInterface $element
     * @return self
     */
    public function addElement(Element\ElementInterface $element)
    {
        $this->elements[] = $element;
        return $this;
    }

    /**
     * @param  DataSet\DataSet $dataSet
     * @return self
     */
    public function addDataSet(DataSet\DataSet $dataSet)
    {
        $this->dataSets[] = $dataSet;

        return $this;
    }

    public function getDataSets()
    {
        return $this->dataSets;
    }

    /**
     * @param  Config\Title $title
     * @return self
     */
    public function setTitle(Config\Title $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Config\Title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param  Config\Size $size
     * @return self
     */
    public function setSize(Config\Size $size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return Config\Size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param  Config\Margin $margin
     * @return self
     */
    public function setMargin(Config\Margin $margin)
    {
        $this->margin = $margin;

        return $this;
    }

    /**
     * @return Config\Margin
     */
    public function getMargin()
    {
        return $this->margin;
    }

    /**
     * @param  Config\Legend  $legend
     * @return self
     */
    public function setLegend(Config\Legend $legend)
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * @return Legend
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }
}
