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
    
    protected $type;
    
    /**
     * @param  ElementInterface $element
     * @return self
     */
    public function addElement(Element\ElementInterface $element)
    {
        $this->elements[] = $element;
        return $this;
    }

    /**
     * @param  array
     * @return self
     */
    public function addData(array $data)
    {
        $this->data = $data;
        return $this;
    }
    
    public function getData()
    {
        return $this->data;
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

    /**
     * @return array
     */
    public function getSize()
    {
        return [$this->height, $this->width];
    }
    
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }
}
