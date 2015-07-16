<?php

namespace Outspaced\ChartsiaBundle\Chart\Axis;

class AxisCollection
{
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
}
