<?php

namespace Outspaced\ChartsiaBundle\Chart\Axis;

class AxisCollection
{
    /**
     * @var Axis
     */
    protected $topAxis;

    /**
     * @var Axis
     */
    protected $bottomAxis;

    /**
     * @var Axis
     */
    protected $leftAxis;

    /**
     * @var Axis
     */
    protected $rightAxis;

    /**
     * @param  Axis  $axis
     * @return self
     */
    public function setTopAxis(Axis $axis)
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
     * @param  Axis  $axis
     * @return self
     */
    public function setBottomAxis(Axis $axis)
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
     * @param  Axis  $axis
     * @return self
     */
    public function setLeftAxis(Axis $axis)
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
     * @param  Axis  $axis
     * @return self
     */
    public function setRightAxis(Axis $axis)
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
}
