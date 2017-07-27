<?php

namespace Outspaced\ChartsiaBundle\Chart\Traits\Property;

trait LabelTrait
{
    /**
     * @var string/number
     */
    protected $label;

    /**
     * @param  string/number $label
     * @return self
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string/number
     */
    public function getLabel()
    {
        return $this->label;
    }
}
