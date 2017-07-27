<?php

namespace Outspaced\ChartsiaBundle\Chart\Renderer;

use Outspaced\ChartsiaBundle\Chart\Charts;
use Outspaced\ChartsiaBundle\Chart\Config;
use Outspaced\ChartsiaBundle\Chart\Component;
use Outspaced\ChartsiaBundle\Chart\Axis;

/**
 * This library has been deprecated by Google, although the API is still available
 */
class Image
{
    /**
     * @var string
     */
    const BASE_URL = 'http://chart.googleapis.com/chart?';

    /**
     * @param string $type
     */
    protected function renderType($type = null)
    {
        if ($type === null) {
            return '';
        }

        return 'cht='.$type.'&';
    }

    /**
     * @param  Config\Size $size
     * @return string
     */
    protected function renderSize(Config\Size $size = null)
    {
        if ($size === null) {
            return '';
        }

        return 'chs='.implode('x', $size->getDimensions()).'&';
    }

    /**
     * @param  Config\Margin $margin
     * @return string
     */
    protected function renderMargin(Config\Margin $margin = null)
    {
        if ($margin === null) {
            return '';
        }

        return 'chma='.implode(',', $margin->getDimensions()).'&';
    }

    /**
     * @param  array $legendLabels
     * @return string
     */
    protected function renderLegendLabels(array $legendLabels = [])
    {
        if (empty($legendLabels)) {
            return '';
        }

        return 'chdl='.implode('|', $legendLabels).'&';
    }

    /**
     * @param  array $lineColors
     * @return string
     */
    protected function renderLineColors(array $lineColors = [])
    {
        if (empty($lineColors)) {
            return '';
        }

        return 'chco='.implode(',', $lineColors).'&';
    }

    /**
     * @param  Config\Title $title
     * @return string
     */
    protected function renderTitle(Config\Title $title = null)
    {
        if ($title === null) {
            return '';
        }

        $url = 'chtt='.urlencode($title->getTitle()).'&';

        if ($title->getColor() !== null) {
            $url .= 'chts='.$title->getColor()->getColor().'&';
        }

        return $url;
    }

    /**
     * @param Config\Legend $chartLegend
     * @return string
     */
    protected function renderChartLegend(Config\Legend $chartLegend = null)
    {
        if ($chartLegend === null) {
            return '';
        }

        //chdlp=<opt_position>|<opt_label_order>
        return 'chdls='.$this->renderColor($chartLegend->getColor()).','.$chartLegend->getFontSize().'&';
    }

    /**
     * Oh this is in dire need of a refactor
     *
     * @param  Axis\AxisCollectionCollection $axisCollectionCollection
     * @return string
     */
    protected function renderAxisCollectionCollection(Axis\AxisCollectionCollection $axisCollectionCollection = null)
    {
        if ($axisCollectionCollection === null) {
            return '';
        }

        /**
         * STEP 1
         */
        $possibleAxisKeys = [
            't' => 'top',
            'x' => 'bottom',
            'y' => 'left',
            'r' => 'right'
        ];

        $actualAxisKeys = [];

        foreach ($possibleAxisKeys as $possibleAxisKey => $possibleAxisName) {
            $method = 'get'.ucwords($possibleAxisName).'AxisCollection';

            $count = $this->countTheAxis($axisCollectionCollection->$method());

            $actualAxisKeys = array_pad($actualAxisKeys, count($actualAxisKeys) + $count, $possibleAxisKey);
        }

        $axesData = $actualAxisKeys;
        $axesData = array_filter($axesData);

        if (empty($axesData)) {
            return '';
        }

        $urlData = 'chxt='.implode(',', array_values($axesData)).'&';

        /**
         * STEP 2
         */
        // render the labels
        $labels = [];
        $positions = [];

        foreach ($possibleAxisKeys as $possibleAxisKey => $possibleAxisName) {
            $method = 'get'.ucwords($possibleAxisName).'AxisCollection';


            // But following this, how did I know the index of the thing being done?

            // Add the labels from this axis to the labels array
            $labels = array_merge(
                $labels,
                $this->renderAxisCollectionLabels($axisCollectionCollection->$method())
            );

            dump($labels);

            // Add the positions from this axis to the positions array
            $positions = array_merge(
                $positions,
                $this->renderAxisCollectionPositions($axisCollectionCollection->$method())
            );

            dump($positions);
        }

        /**
         * STEP 3
         *
         * (Refactor me!)
         */
//        $xGridlines =





        // render the gridlines
        $gridlines = [];

        foreach ($possibleAxisKeys as $possibleAxisKey => $possibleAxisName) {


            // Actually no, fuck this
            // @todo make this atrocity better
            if (!in_array($possibleAxisKey, ['x', 'y'])) {
                continue;
            }

            $method = 'get'.ucwords($possibleAxisName).'AxisCollection';

            /*
            // Add the labels from this axis to the labels array
            $g = array_merge(
                $labels,
                $this->renderAxisCollectionLabels($axisCollectionCollection->$method())
            );

            dump($labels);

            // Add the positions from this axis to the positions array
            $positions = array_merge(
                $positions,
                $this->renderAxisCollectionPositions($axisCollectionCollection->$method())
            );

            dump($positions);
            */
        }

        $positions = array_filter($positions);
        $labels    = array_filter($labels);

        // Labels
        if (!empty($labels)) {
            $urlData .= 'chxl=';

            foreach ($labels as $labelKey => $labelValue) {
                $urlData .= $labelKey.':|'.$labelValue.'|';
            }

            $urlData .= '&';
        }

        if (!empty($positions)) {
            $urlData .= 'chxp=';
            foreach ($positions as $positionKey => $positionValue) {
                $urlData .= $positionKey.','.$positionValue.'|';
            }
            $urlData = rtrim($urlData, "|");
            $urlData .= '&';
        }

        return $urlData;
    }

    /**
     * Needs to be moved to a renderAxis class
     *
     * @param  Axis\AxisCollection $axisCollection
     * @return int;
     */
    protected function countTheAxis(Axis\AxisCollection $axisCollection = null)
    {
        if ($axisCollection === null) {
            return 0;
        }

        return $axisCollection->count();
    }

    /**
     * Needs to be moved to a renderAxis class
     *
     * @param  Axis\AxisCollection $axisCollection
     * @return array
     */
    protected function renderAxisCollectionLabels(Axis\AxisCollection $axisCollection = null)
    {
        if ($axisCollection === null) {
            return [];
        }

        $labelArray = [];

        foreach ($axisCollection as $axis) {

            $labelTexts = [];

            foreach ($axis->getLabels() as $label) {

                $labelTexts[] = $label->getLabel();

            }

            $labelArray[] = implode('|', $labelTexts);
        }

        return $labelArray;
    }

    /**
     * Needs to be moved to a renderAxis class
     *
     * @param  Axis\AxisCollection $axisCollection
     * @return array
     */
    protected function renderAxisCollectionPositions(Axis\AxisCollection $axisCollection = null)
    {
        if ($axisCollection === null) {
            return [];
        }

        $positionArray = [];

        foreach ($axisCollection as $axis) {
            $positionTexts = [];

            foreach ($axis->getLabels() as $label) {

                $positionTexts[] = $label->getPosition();

            }

            $positionArray[] = implode('|', $positionTexts);
        }

        return $positionArray;
    }

    /**
     * Needs to be moved to a renderAxis class
     *
     * Actually this doesn't work, these are still Axis objects
     *
     * @param  Axis\AxisCollection $axisCollection
     * @return array
     */
    protected function renderAxisCollection(Axis\AxisCollection $axisCollection = null)
    {
        if ($axisCollection === null) {
            return [];
        }

        return $axisCollection->getAxes();
    }

    /**
     * @param  Component\Color $color
     * @return string
     *
     * This is now DUPLICATED - need to make the decision if the renderers will extend a
     * common class now
     */
    protected function renderColor(Component\Color $color = null)
    {
        if ($color === null) {
            return '';
        }

        return $color->getColor();
    }




    protected function renderAxisTing(Charts\LineChart $chart)
    {
        $possibleAxisKeys = [
            't' => 'top',
            'x' => 'bottom',
            'y' => 'left',
            'r' => 'right'
        ];

        $actualAxes = [];
        $titles     = [];
        $positions  = [];
        $labels     = [];

        foreach ($possibleAxisKeys as $possibleAxisKey => $possibleAxisName) {

            $method = 'get'.ucwords($possibleAxisName).'Axis';

            // eg getTopAxis, getLeftAxis
            if ($axis = $chart->{$method}()) {

                $actualAxes[] = $possibleAxisKey;

                if ($labelTings = $axis->getLabels()) {

                    $labelTexts = [];
                    $positionTings = [];

                    foreach ($labelTings as $label) {
                        $labelTexts[] = $label->getLabel();
                        $positionTings[]  = $label->getPosition();
                    }

                    $labels[$this->getCurrentKeyFromAxesArray($actualAxes)] = implode('|', $labelTexts);
                    $positions[$this->getCurrentKeyFromAxesArray($actualAxes)] = implode(',', $positionTings);
                } else {

                    // THINK ABOUT THIS ONE
                    // So - do I want to display nothing if user ain't said nothing?
                    $labels[$this->getCurrentKeyFromAxesArray($actualAxes)] = '';
                }

                if ($title = $axis->getTitle()) {
                    $actualAxes[] = $possibleAxisKey;

                    $labels[$this->getCurrentKeyFromAxesArray($actualAxes)] = $title->getValue();

                    $positions[$this->getCurrentKeyFromAxesArray($actualAxes)] = $title->getPosition();
                }
            }
        }

        $urlData = 'chxt='.implode(',', array_values($actualAxes)).'&';

        // Labels
        if (!empty($labels)) {
            $urlData .= 'chxl=';

            foreach ($labels as $labelKey => $labelValue) {
                $urlData .= $labelKey.':|'.$labelValue.'|';
            }

            $urlData .= '&';
        }

        if (!empty($positions)) {
            $urlData .= 'chxp=';
            foreach ($positions as $positionKey => $positionValue) {
                $urlData .= $positionKey.','.$positionValue.'|';
            }
            $urlData = rtrim($urlData, "|");
            $urlData .= '&';
        }

        return $urlData;
    }

    /**
     * Gets the current highest key from $axes array
     *
     * @param  array $axes
     * @return int
     */
    protected function getCurrentKeyFromAxesArray(array $axes)
    {
        end($axes);

        return key($axes);
    }

    /**
     * @param  Charts\BaseChart $chart
     * @return string
     */
    public function render(Charts\LineChart $chart)
    {
        $url = self::BASE_URL;

        $url .= $this->renderType($chart->getType());
        $url .= $this->renderSize($chart->getSize());
        $url .= $this->renderMargin($chart->getMargin());
        $url .= $this->renderChartLegend($chart->getLegend());
        $url .= $this->renderTitle($chart->getTitle());


        // $url .= $this->renderAxisCollectionCollection($chart->getAxisCollectionCollection());
        $url .= $this->renderAxisTing($chart);

        // DATA SETS
        $data = [];
        $lineColors = [];
        $legendLabels = [];

        foreach ($chart->getDataSetCollection() as $dataSet) {

            $data[] = implode(',', $dataSet->getData());

            $lineColors[] = $this->renderColor($dataSet->getColor());

            if ($legend = $dataSet->getLegend()) {
                $legendLabels[] = urlencode($legend->getLabel());
            }
        }

        // Dataset data
        $url .= 'chd=t:'.implode('|', $data).'&';

        $url .= $this->renderLineColors($lineColors);
        $url .= $this->renderLegendLabels($legendLabels);

        return $url;
    }
}
