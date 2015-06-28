<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\Component;

class Color
{
    /**
     * @var string
     */
    protected $color;
    
    /**
     * @param string $color - requires HTML-friendly code
     * @return \Outspaced\GoogleChartMakerBundle\Chart\Component\Color
     */
    public function __construct($color=NULL)
    {
        if ($color) {
            return $this->setColor($color);
        }
        
        return $this;
    }

    /**
     * @param string $color
     * @return \Outspaced\GoogleChartMakerBundle\Chart\Component\Color
     */
    public function setColor($color)
    {
        $this->color = $color;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }
}
