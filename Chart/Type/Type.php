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
     * @var bool
     */
    protected $dataMarkers;

    /**
     * @param bool $dataMarkers
     * @return self
     */
    public function addDataMarkers($dataMarkers)
    {
        $this->dataMarkers = $dataMarkers;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDataMarkers()
    {
        return $this->dataMarkers;
    }

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
