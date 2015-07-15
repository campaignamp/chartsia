<?php

namespace Outspaced\ChartsiaBundle\Chart\Charts;

use Outspaced\ChartsiaBundle\Chart\Element;
use Outspaced\ChartsiaBundle\Chart\Config;
use Outspaced\ChartsiaBundle\Chart\DataSet;

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
     * @var DataSet\DataSetCollection
     */
    protected $dataSetCollection;

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
     * @var Axis\Axis
     */
    protected $topAxis;

    /**
     * @var Axis\Axis
     */
    protected $bottomAxis;

    /**
     * @var Axis\Axis
     */
    protected $leftAxis;

    /**
     * @var Axis\Axis
     */
    protected $rightAxis;

    /**
     * @param  Element\ElementInterface $element
     * @return self
     */
    public function addElement(Element\ElementInterface $element)
    {
        $this->elements[] = $element;
        return $this;
    }

//     /**
//      * @param  DataSet\DataSet $dataSet
//      * @return self
//      */
//     public function addDataSet(DataSet\DataSet $dataSet)
//     {
//         $this->dataSets[] = $dataSet;

//         return $this;
//     }

//     /**
//      * @return array
//      */
//     public function getDataSets()
//     {
//         return $this->dataSets;
//     }
    /**
     * @param  DataSet\DataSetCollection $dataSetCollection
     * @return self
     */
    public function setDataSetCollection(DataSet\DataSetCollection $dataSetCollection)
    {
        $this->dataSetCollection = $dataSetCollection;

        return $this;
    }

    /**
     * @return DataSet\DataSetCollection
     */
    public function getDataSetCollection()
    {
        return $this->dataSetCollection;
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
     * @param  Axis\Axis  $axis
     * @return self
     */
    public function setTopAxis(Axis\Axis $axis)
    {
        $this->topAxis = $axis;

        return $this;
    }

    /**
     * @return Axis
     */
    public function getTopAxis()
    {
        return $this->topAxis;
    }

    /**
     * @param  Axis\Axis  $axis
     * @return self
     */
    public function setBottomAxis(Axis\Axis $axis)
    {
        $this->bottomAxis = $axis;

        return $this;
    }

    /**
     * @return Axis
     */
    public function getBottomAxis()
    {
        return $this->bottomAxis;
    }

    /**
     * @param  Axis\Axis  $axis
     * @return self
     */
    public function setLeftAxis(Axis\Axis $axis)
    {
        $this->leftAxis = $axis;

        return $this;
    }

    /**
     * @return Axis
     */
    public function getLeftAxis()
    {
        return $this->leftAxis;
    }

    /**
     * @param  Axis\Axis  $axis
     * @return self
     */
    public function setRightAxis(Axis\Axis $axis)
    {
        $this->rightAxis = $axis;

        return $this;
    }

    /**
     * @return Axis
     */
    public function getRightAxis()
    {
        return $this->rightAxis;
    }

    /**
     * Get all axes as an array
     * @return array
     */
    public function getAxes()
    {
        $axes = [
            $this->topAxis,
            $this->bottomAxis,
            $this->leftAxis,
            $this->rightAxis
        ];

        $axes = array_filter($axes);

        return array_values($axes);
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
