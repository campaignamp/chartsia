<?php

namespace Outspaced\ChartsiaBundle\Chart\Type;

abstract class Type
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $chartCode;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $code
     * @return self
     */
    public function setChartCode($code)
    {
        $this->chartCode = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getChartCode()
    {
        return $this->chartCode;
    }
}
