<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\DataSet;

use Outspaced\GoogleChartMakerBundle\Chart\DataSet\Legend;
use Outspaced\GoogleChartMakerBundle\Chart\Component\Color;

class DataSet
{
    use \Outspaced\GoogleChartMakerBundle\Chart\Traits\ColorTrait;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var Color
     */
    protected $color;

    /**
     * @var Legend
     */
    protected $legend;

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
     * @param  Legend  $legend
     * @return self
     */
    public function setLegend(Legend $legend)
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * @return Legend
     */
    public function getLegend()
    {
        return $this->legend;
    }
}
