<?php

namespace Outspaced\ChartsiaBundle\Chart\Axis;

use Outspaced\ChartsiaBundle\Chart\Component;

class Axis
{
    /**
     * @var Label[]
     */
    protected $labels = [];

    /**
     * @var Range
     */
    protected $range;

    /**
     * @var Tick
     */
    protected $tick;

    /**
     * @var Component\Color
     */
    protected $color;

    /**
     * @param  Label  $label
     * @return self
     */
    public function addLabel(Label $label)
    {
        $this->labels[] = $label;

        return $this;
    }

    /**
     * @return Label
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * @param  Range  $range
     * @return self
     */
    public function setRange(Range $range)
    {
        $this->range = $range;

        return $this;
    }

    /**
     * @return Range
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * @param  Tick  $tick
     * @return self
     */
    public function setTick(Tick $tick)
    {
        $this->tick = $tick;

        return $this;
    }

    /**
     * @return Tick
     */
    public function getTick()
    {
        return $this->tick;
    }

    /**
     * @param  Component\Color  $color
     * @return self
     */
    public function setColor(Component\Color $color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Component\Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Takes a list of of possible label keys, and reduces them to ones that
     *   are $step steps apart
     *
     * @param array $labelSet
     * @param int   $step
     */
    public function createLabels(array $labelSet, $step = 1)
    {
        $labels = [];
        $labelSetCount = count($labelSet);

        for ($i = 0 ; $i < $labelSetCount ; $i++) {
            if ($step > 1) {
                if ($i % $step) {
                    $labelSet[$i] = '';
                }
            }

            $labels[] = new Label($labelSet[$i]);
        }

        $this->labels = $labels;
    }
}
