<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\Config;

use Outspaced\GoogleChartMakerBundle\Chart\Traits;

/**
 * Title element, common to all charts
 *
 * @author Alex Brims <alex.brims@gmail.com>
 */
class Title
{
    use Traits\ColorTrait;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var Font size?
     */
    protected $fontSize;

    /**
     * @var Alignment??
     */
    protected $alignment;

    /**
     * @param  string
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Not implementing the other properties for now
     */
}
