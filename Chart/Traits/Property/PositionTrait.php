<?php

namespace Outspaced\ChartsiaBundle\Chart\Traits\Property;

trait PositionTrait
{
    /**
     * @var number
     */
    protected $position;

    /**
     * @param  number $position
     * @return self
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return number
     */
    public function getPosition()
    {
        return $this->position;
    }
}
