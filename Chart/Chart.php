<?php

namespace Outspaced\GoogleChartMakerBundle;

use Outspaced\GoogleChartMakerBundle\Chart\Element\ElementInterface;

class Chart 
{
    protected $elements = [];
    
    /**
     * 
     * @param  ElementInterface $element
     * @return self
     */
    public function addElement(ElementInterface $element)
    {
        // Elements can be anything that can be added to the chart
        
        
        return $this;
    }
    
    public function render()
    {
        
    }
}