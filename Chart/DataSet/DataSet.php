<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\DataSet;

class DataSet
{
    /**
     * @var array
     */
    protected $data = [];
    
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
}