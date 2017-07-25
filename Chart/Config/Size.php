<?php

namespace Outspaced\ChartsiaBundle\Chart\Config;

/**
 * Contains config elements that are common to all charts
 *
 * @author Alex Brims <alex.brims@gmail.com>
 */
class Size
{
    /**
     * @var int
     */
    protected $height;

    /**
     * @var int
     */
    protected $width;

    /**
     * @param int $height
     * @param int $width
     */
    public function __construct($height = null, $width = null)
    {
        if ($height !== null) {
            $this->setHeight($height);
        }

        if ($width !== null) {
            $this->setWidth($width);
        }
    }

    /**
     * @param  int  $height
     * @return self
     */
    public function setHeight($height)
    {
        if (!is_int($height)) {
            throw new \InvalidArgumentException('Size height must be an int');
        }

        $this->height = $height;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param  int  $width
     * @return self
     */
    public function setWidth($width)
    {
        if ( ! is_int($width)) {
            throw new \InvalidArgumentException('Size width must be an int');
        }

        $this->width = $width;

        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Helper method for getting both properties at once
     * @return array
     */
    public function getDimensions()
    {
        return [$this->width, $this->height];
    }
}
