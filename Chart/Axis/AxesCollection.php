<?php

namespace Outspaced\ChartsiaBundle\Chart\Axis;

class AxesCollection
{
    /**
     * @var AxisCollection
     */
    protected $topAxisCollection;

    /**
     * @var AxisCollection
     */
    protected $bottomAxisCollection;

    /**
     * @var AxisCollection
     */
    protected $leftAxisCollection;

    /**
     * @var AxisCollection
     */
    protected $rightAxisCollection;

    /**
     * @param  AxisCollection  $axisCollection
     * @return self
     */
    public function setTopAxisCollection(AxisCollection $axisCollection)
    {
        $this->topAxisCollection = $axisCollection;

        return $this;
    }

    /**
     * @return AxisCollection
     */
    public function getTopAxisCollection()
    {
        return $this->topAxisCollection;
    }

    /**
     * @param  AxisCollection  $axisCollection
     * @return self
     */
    public function setBottomAxisCollection(AxisCollection $axisCollection)
    {
        $this->bottomAxisCollection = $axisCollection;

        return $this;
    }

    /**
     * @return AxisCollection
     */
    public function getBottomAxisCollection()
    {
        return $this->bottomAxisCollection;
    }

    /**
     * @param  AxisCollection  $axisCollection
     * @return self
     */
    public function setLeftAxisCollection(AxisCollection $axisCollection)
    {
        $this->leftAxisCollection = $axisCollection;

        return $this;
    }

    /**
     * @return AxisCollection
     */
    public function getLeftAxisCollection()
    {
        return $this->leftAxisCollection;
    }

    /**
     * @param  AxisCollection  $axisCollection
     * @return self
     */
    public function setRightAxisCollection(AxisCollection $axisCollection)
    {
        $this->rightAxisCollection = $axisCollection;

        return $this;
    }

    /**
     * @return AxisCollection
     */
    public function getRightAxisCollection()
    {
        return $this->rightAxisCollection;
    }

    /**
     * Get all axes as an array
     * @return array
     */
    public function getAxes()
    {
        $axes = [
            $this->topAxisCollection,
            $this->bottomAxisCollection,
            $this->leftAxisCollection,
            $this->rightAxisCollection
        ];

        $axes = array_filter($axes);

        return array_values($axes);
    }
}
