<?php

namespace Outspaced\ChartsiaBundle\Chart\Traits\Property;

trait ValueTrait
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param  mixed $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
