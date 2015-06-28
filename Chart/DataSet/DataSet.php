<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\DataSet;

class DataSet
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var \Outspaced\GoogleChartMakerBundle\Chart\Component\Color
     */
    protected $color;
    
    /**
     * Overwrites the data to value in $data
     * 
     * @param  array $data
     * @return self
     */
    public function setData(array $data)
    {
        $this->data = [];
        
        foreach ($data as $datum) {
            $this->addData($datum);
        }
        
        return $this;
    }

    /**
     * @return array
     */
    public function getData() 
    {
        return $this->data;
    }

    /**
     * @param  int (I think?)
     * @return self
     */
    public function addData($data) 
    {
        $this->data[] = $data;
        
        return $this;
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
}
