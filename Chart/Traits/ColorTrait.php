<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\Traits;

trait ColorTrait
{
    /**
     * @param  \Outspaced\GoogleChartMakerBundle\Chart\Component\Color $color
     * @return self
     */
    public function setColor(\Outspaced\GoogleChartMakerBundle\Chart\Component\Color $color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return \Outspaced\GoogleChartMakerBundle\Chart\Component\Color
     */
    public function getColor()
    {
        // If no color has been set then this returns null - should it return an empty color?

        return $this->color;
    }
}
