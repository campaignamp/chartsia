<?php

namespace Outspaced\ChartsiaBundle\Chart\Axis;

use Outspaced\ChartsiaBundle\Chart\Traits\Property as PropertyTrait;

class Label
{
    use PropertyTrait\LabelTrait;
    use PropertyTrait\PositionTrait;

    /**
     * @param string $label
     * @param int    $position
     */
    public function __construct($label = null, $position = null)
    {
        $this->label = $label;

        $this->position = $position;
    }
}
