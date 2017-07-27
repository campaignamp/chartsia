<?php

namespace Outspaced\ChartsiaBundle\Chart\Axis;

use Outspaced\ChartsiaBundle\Chart\Traits\Property as PropertyTrait;

class Title
{
    use PropertyTrait\ValueTrait;
    use PropertyTrait\PositionTrait;

    /**
     * @param string $value
     * @param int    $position
     */
    public function __construct($value = null, $position = null)
    {
        $this->value = $value;

        $this->position = $position;
    }
}
