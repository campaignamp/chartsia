<?php

namespace Outspaced\ChartsiaBundle\Chart\Axis;

class Label
{
    /**
     * @var string
     */
    protected $label;

    protected $position;

    protected $format;

    protected $color;

    protected $font;

    protected $alignment;

    protected $axisOrTick;

    /**
     * @param  string  $label
     * @return self
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param  int  $position
     * @return self
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }
}
