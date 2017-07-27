<?php

namespace Outspaced\ChartsiaBundle\Chart\Traits\Property;

trait LabelTrait
{
    /**
     * @var mixed
     */
    protected $label;

    /**
     * @param  mixed $label
     * @return self
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }
}
