<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\Traits;

use Outspaced\GoogleChartMakerBundle\Chart\Component;

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
        // If no color has been set then this returns null - should it return an empty color?

        return $this->color;
    }
}
