<?php

namespace Outspaced\ChartsiaBundle\Chart\Traits;

use Outspaced\ChartsiaBundle\Chart\Component;

trait ColorTrait
{
    /**
     * @var Component\Color
     */
    protected $color;

    /**
     * @param  Component\Color $color
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
