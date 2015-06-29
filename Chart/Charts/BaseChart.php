<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\Charts;

use Outspaced\GoogleChartMakerBundle\Chart\Element;

abstract class BaseChart
{
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
     * @param  ElementInterface $element
     * @return self
     */
    public function addElement(Element\ElementInterface $element)
    {
        $this->elements[] = $element;
        return $this;
    }

    /**
     * @param  \Outspaced\GoogleChartMakerBundle\Chart\DataSet\DataSet $dataSet
     * @return self
     */
    public function addDataSet(\Outspaced\GoogleChartMakerBundle\Chart\DataSet\DataSet $dataSet)
    {
        $this->dataSets[] = $dataSet;

        return $this;
    }

    public function getDataSets()
    {
        return $this->dataSets;
    }

    /**
     * @param  \Outspaced\GoogleChartMakerBundle\Chart\Config\Title $title
     * @return self
     */
    public function setTitle(\Outspaced\GoogleChartMakerBundle\Chart\Config\Title $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return \Outspaced\GoogleChartMakerBundle\Chart\Charts\Title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param  int $height
     * @param  int $width
     * @return self
     */
    public function setSize($height, $width)
    {
        $this->height = $height;
        $this->width = $width;

        return $this;
    }

    /**
     * @return array
     */
    public function getSize()
    {
        return [$this->height, $this->width];
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
