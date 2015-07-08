<?php

namespace Outspaced\ChartsiaBundle\Chart\Axis;

class Label
{
    // Not implemented yet

    /**
     * @var array
     */
    protected $labels;

    protected $positions;

    protected $format;

    protected $color;

    protected $font;

    protected $alignment;

    protected $axisOrTick;











    /* What follows is redundant and will be removed once I'm 100% certain it's not needed */

    /**
     * @var array
     */
    protected $data = [];

    /**
     *
     * So is this only relevant for the image-based rendering
     *
     * @var string
     */
    protected $key = 'chxl';

    /**
     * Adds a value, so should probably be called addElement
     *
     * @param  string $value
     * @return self
     */
    public function add($value)
    {
        $this->data[] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}
