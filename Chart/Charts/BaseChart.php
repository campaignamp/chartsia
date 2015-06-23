<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\Charts;

use Outspaced\GoogleChartMakerBundle\Chart\Element;

abstract class BaseChart 
{
	/**
	 * @var array
	 */
    protected $elements = [];
    
    protected $height;

    protected $width;
    
    
    /**
     * 
     * @param  ElementInterface $element
     * @return self
     */
    public function addElement(Element\ElementInterface $element)
    {
        $this->elements[] = $element;
        return $this;
    }
    
    public function render()
    {
        return 'NOT RENDERING YET';
    }
    
    public function getData()
    {
        // tmp
        return $this;
    }
    
    /**
     * @param  int $height
     * @param  int $width
     * @return self
     */
    public function setSize($height, $width)
    {
        $this->height = $height;
        $this->width = $width;
        
        return $this;
    }
}
