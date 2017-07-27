<?php

namespace Outspaced\ChartsiaBundle\Chart\Axis;

class Title
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var int
     */
    protected $position;

    /**
     * @param string $value
     * @param int    $position
     */
    public function __construct($value = null, $position = null)
    {
        $this->value = $value;

        $this->position = $position;
    }

    /**
     * @param  string  $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param  int  $position
     * @return self
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }
}
