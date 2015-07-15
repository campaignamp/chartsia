<?php

namespace Outspaced\ChartsiaBundle\Chart\DataSet;

class DataSetCollection implements \Iterator {

    /**
     * @var array
     */
    protected $dataSets = [];

    /**
     * @param  DataSet $dataSet
     * @return self
     */
    public function add(DataSet $dataSet)
    {
        $this->dataSets[] = $dataSet;

        return $this;
    }

    /**
     * Removes a DataSet if present
     *
     * @param  DataSet $dataSet
     * @return self
     */
    public function remove(DataSet $dataSet)
    {
        $key = array_search($dataSet, $this->dataSets);

        // Remove key and reindex
        if ($key !== false) {
            unset($this->dataSets[$key]);
            $this->dataSets = array_values($this->dataSets);
        }

        return $this;
    }

    /**
     * @return DataSet|null
     */
    function rewind()
    {
        return reset($this->dataSets);
    }

    /**
     * @return DataSet|null
     */
    function current()
    {
        return current($this->dataSets);
    }

    /**
     * @return int
     */
    function key()
    {
        return key($this->dataSets);
    }

    /**
     * @return DataSet|null
     */
    function next()
    {
        return next($this->dataSets);
    }

    /**
     * @return bool
     */
    function valid()
    {
        return key($this->dataSets) !== null;
    }
}
