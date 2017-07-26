<?php

namespace Outspaced\ChartsiaBundle\Chart\Axis;


class Gridlines
{
    /**
     * @var int
     */
    protected $stepSize;

    /**
     * @var int
     */
    protected $offset;

    /**
     * @param int $stepSize
     * @param int $offset
     */
    public function __construct($stepSize = null, $offset = null)
    {
        $this->stepSize = $stepSize;

        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getStepSize()
    {
        return $this->stepSize;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int
     * @return Gridlines
     */
    public function setStepSize($stepSize)
    {
        $this->stepSize = $stepSize;

        return $this;
    }
    /**
     * @param int
     * @return Gridlines
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }
}
