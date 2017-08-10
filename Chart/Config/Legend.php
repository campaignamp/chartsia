<?php

namespace Outspaced\ChartsiaBundle\Chart\Config;

use Outspaced\ChartsiaBundle\Chart\Component\Color;

/**
 * @author Alex Brims <alex.brims@gmail.com>
 */
class Legend
{
    // key for next piece is chdlp=<opt_position>|<opt_label_order>

    /**
     * @var string
     */
    protected $position;

    /**
     * @var Color
     */
    protected $color;

    /**
     * @var int
     */
    protected $fontSize;

    /**
     * @param  string  $position
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

    /**
     * @param  Color  $color
     * @return self
     */
    public function setColor(Color $color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param  int  $fontSize
     * @return self
     */
    public function setFontSize($fontSize)
    {
        if (!is_int($fontSize)) {
            throw new \InvalidArgumentException('Legend fontSize must be an int');
        }

        $this->fontSize = $fontSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }
}
