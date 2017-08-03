<?php

namespace Outspaced\ChartsiaBundle\Chart\Config;

class Type
{
    /**
     * @var string
     */
    protected $type;

    /**
     */
    public function __construct($type = null)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string
     * @return Type
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
