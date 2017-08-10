<?php

namespace Outspaced\ChartsiaBundle\Chart\Config;

/**
 * Contains config elements that are common to all charts
 *
 * @author Alex Brims <alex.brims@gmail.com>
 */
class Margin
{
    /**
     * @var int
     */
    protected $left;

    /**
     * @var int
     */
    protected $right;

    /**
     * @var int
     */
    protected $top;

    /**
     * @var int
     */
    protected $bottom;

    /**
     * @var int
     */
    protected $legendHeight;

    /**
     * @var int
     */
    protected $legendWidth;

    /**
     * @param int $left
     * @param int $bottom
     * @param int $right
     * @param int $top
     */
    public function __construct($left = NULL, $right = NULL, $top = NULL, $bottom = NULL)
    {
        if ($left !== NULL) {
            $this->setLeft($left);
        }

        if ($right !== NULL) {
            $this->setRight($right);
        }

        if ($top !== NULL) {
            $this->setTop($top);
        }

        if ($bottom !== NULL) {
            $this->setBottom($bottom);
        }
    }

    /**
     * @param  int  $left
     * @return self
     */
    public function setLeft($left)
    {
        $this->left = $left;

        return $this;
    }

    /**
     * @return int
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param  int  $right
     * @return self
     */
    public function setRight($right)
    {
        $this->right = $right;

        return $this;
    }

    /**
     * @return int
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @param  int  $top
     * @return self
     */
    public function setTop($top)
    {
        $this->top = $top;

        return $this;
    }

    /**
     * @return int
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * @param  int  $bottom
     * @return self
     */
    public function setBottom($bottom)
    {
        $this->bottom = $bottom;

        return $this;
    }

    /**
     * @return int
     */
    public function getBottom()
    {
        return $this->bottom;
    }

    /**
     * @param  int  $height
     * @return self
     */
    public function setLegendHeight($height)
    {
        $this->legendHeight = $height;

        return $this;
    }

    /**
     * @return int
     */
    public function getLegendHeight()
    {
        return $this->legendHeight;
    }

    /**
     * @param  int  $width
     * @return self
     */
    public function setLegendWidth($width)
    {
        $this->legendWidth = $width;

        return $this;
    }

    /**
     * @return int
     */
    public function getLegendWidth()
    {
        return $this->legendWidth;
    }

    /**
     * Helper method for getting all properties at once
     * @return array
     */
    public function getDimensions()
    {
        $return = [
            $this->left,
            $this->right,
            $this->top,
            $this->bottom,
        ];

        if ($this->legendHeight) {
            $return[] = $this->legendHeight;
        }

        if ($this->legendWidth) {
            // Fill with a null value if only the width has been specified
            if (!$this->legendHeight) {
                $return[] = NULL;
            }

            $return[] = $this->legendWidth;
        }

        return $return;
    }
}
