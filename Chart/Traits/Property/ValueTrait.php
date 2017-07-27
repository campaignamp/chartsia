<?php

namespace Outspaced\ChartsiaBundle\Chart\Traits\Property;

trait ValueTrait
{
    /**
     * @var string/number
     */
    protected $value;

    /**
     * @param  string/number $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string/number
     */
    public function getValue()
    {
        return $this->value;
    }
}
