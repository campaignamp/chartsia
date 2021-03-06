<?php

namespace Outspaced\ChartsiaBundle\Chart\DataSet;

use Outspaced\ChartsiaBundle\Chart\Component;

class DataSet
{
    use \Outspaced\ChartsiaBundle\Chart\Traits\ColorTrait;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var Legend
     */
    protected $legend;

    /**
     * @var Component\Color[]
     */
    protected $colorCollection = [];

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
     * @param  mixed
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

    /**
     * @param  Component\Color[] $colorCollection
     * @return self
     */
    public function setColorCollection(array $colorCollection)
    {
        $this->colorCollection = $colorCollection;

        return $this;
    }

    /**
     * @return Component\Color[]
     */
    public function getColorCollection()
    {
        return $this->colorCollection;
    }

}
