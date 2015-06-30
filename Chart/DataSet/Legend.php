<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\DataSet;

/**
 * @author Alex Brims <alex.brims@gmail.com>
 */
class Legend
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @param  string $legend [optional]
     * @return self
     */
    public function __construct($legend=NULL)
    {
        if ( ! is_null($legend)) {
            return $this->setLabel($legend);
        }

        return $this;
    }

    /**
     * @param  string  $label
     * @return self
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}
