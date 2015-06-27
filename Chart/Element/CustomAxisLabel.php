<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\Element;

class CustomAxisLabel implements ElementInterface
{
    /**
     * @var array
     */
    protected $data = [];
    
    /**
     * 
     * So is this only relevant for the image-based rendering
     * 
     * @var string
     */
    protected $key = 'chxl';
    
    /**
     * Adds a value, so should probably be called addElement
     * 
     * @param  string $value
     * @return self
     */
    public function add($value)
    {
        $this->data[] = $value;
        return $this;
    }
    
    public function render()
    {
        return implode('|', $this->data);
    }
    
    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}
