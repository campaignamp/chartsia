<?php

namespace Outspaced\ChartsiaBundle\Chart\Axis;

use Outspaced\ChartsiaBundle\Chart\Component;

class Axis
{
    /**
     * @var Label
     */
    protected $label;

    /**
     * @var Range
     */
    protected $range;

    /**
     * @var Tick
     */
    protected $tick;

    /**
     * @var COmponent\Color
     */
    protected $color;

    /**
     * @param  Label  $label
     * @return self
     */
    public function setLabel(Label $label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param  Range  $range
     * @return self
     */
    public function setRange(Range $range)
    {
        $this->range = $range;

        return $this;
    }

    /**
     * @return Range
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * @param  Tick  $tick
     * @return self
     */
    public function setTick(Tick $tick)
    {
        $this->tick = $tick;

        return $this;
    }

    /**
     * @return Tick
     */
    public function getTick()
    {
        return $this->tick;
    }

    /**
     * @param  Component\Color  $color
     * @return self
     */
    public function setColor(Component\Color $color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Component\Color
     */
    public function getColor()
    {
        return $this->color;
    }
}
