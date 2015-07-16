<?php

namespace Outspaced\ChartsiaBundle\Chart\Component;

class Color
{
    /**
     * @var string
     */
    protected $color;

    /**
     * @param string $color - requires HTML-friendly code
     */
    public function __construct($color = NULL)
    {
        if ($color !== NULL) {
            $this->setColor($color);
        }
    }

    /**
     * @param  string $color
     * @return self
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
