<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\Config;

/**
 * Title element, common to all charts
 * 
 * @author Alex Brims <alex.brims@gmail.com>
 */
class Title
{
    /**
     * @var string
     */
    protected $title;
    
    /**
     * @var Color
     */
    protected $color;
    
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
    
    /**
     * Not implementing the other properties for now
     */
}