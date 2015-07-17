<?php

namespace Outspaced\ChartsiaBundle\Chart\Axis;

class AxisCollection implements \Iterator, \Countable {

    /**
     * @var array
     */
    protected $axes = [];

    /**
     * @param  Axis $axis
     * @return self
     */
    public function add(Axis $axis)
    {
        $this->axes[] = $axis;

        return $this;
    }

    /**
     * Removes a Axis if present
     *
     * @param  Axis $axis
     * @return self
     */
    public function remove(Axis $axis)
    {
        $key = array_search($axis, $this->axes);

        // Remove key and reindex
        if ($key !== false) {
            unset($this->axes[$key]);
            $this->axes = array_values($this->axes);
        }

        return $this;
    }

    /**
     * @return Axis|null
     */
    public function rewind()
    {
        return reset($this->axes);
    }

    /**
     * @return Axis|null
     */
    public function current()
    {
        return current($this->axes);
    }

    /**
     * @return int
     */
    public function key()
    {
        return key($this->axes);
    }

    /**
     * @return Axis|null
     */
    public function next()
    {
        return next($this->axes);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return key($this->axes) !== null;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->axes);;
    }
}
