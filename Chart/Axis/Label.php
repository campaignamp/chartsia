<?php

namespace Outspaced\ChartsiaBundle\Chart\Axis;

class Label
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @var int
     */
    protected $position;

//     protected $format;

//     protected $color;

//     protected $font;

//     protected $alignment;

//     protected $axisOrTick;

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

    /**
     * @param  int  $position
     * @return self
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }


//     // This part here should not be here, it should live inside Axis
//     public function setLabelViaMarkers(array $markers, $step = 1)
//     {
//         if ($step > 1) {
//             for ($i = 0 ; $i < count($markers) ; $i++) {
//                 if ($i % $step) {
//                     $markers[$i] = '';
//                 }
//             }
//         }

//         $this->label = '';
//     }
}
