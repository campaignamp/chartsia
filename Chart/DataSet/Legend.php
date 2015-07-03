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
     */
    public function __construct($legend=NULL)
    {
        if ($legend !== NULL) {
            $this->setLabel($legend);
        }
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
