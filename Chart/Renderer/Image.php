<?php

namespace Outspaced\ChartsiaBundle\Chart\Renderer;

use Outspaced\ChartsiaBundle\Chart\Charts\BaseChart;
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
        } else {
            return 'cht='.$type.'&';
        }
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
     * @param Config\Margin $margin
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
     * @param  Axis\AxesCollection $axesCollection
     * @return string
     */
    protected function renderAxesCollection(Axis\AxesCollection $axesCollection = null)
    {
        if ($axesCollection === null) {
            return '';
        }

        // So this needs to change innit
        $axesData = [
            't' => $this->renderAxisCollection($axesCollection->getTopAxisCollection()),
            'x' => $this->renderAxisCollection($axesCollection->getBottomAxisCollection()),
            'y' => $this->renderAxisCollection($axesCollection->getLeftAxisCollection()),
            'r' => $this->renderAxisCollection($axesCollection->getRightAxisCollection())
        ];

        $possibleAxisKeys = [
            't' => 'top',
            'x' => 'bottom',
            'y' => 'left',
            'r' => 'right'
        ];

        $actualAxisKeys = [];

        foreach ($possibleAxisKeys as $possibleAxisKey => $possibleAxisName) {
            $method = 'get'.ucwords($possibleAxisName).'AxisCollection';

            $count = $this->countTheFuckingAxis($axesCollection->$method());

            $actualAxisKeys = array_pad($actualAxisKeys, count($actualAxisKeys) + $count, $possibleAxisKey);
        }

        $axesData = array_filter($axesData);

        if (empty($axesData)) {
            return '';
        }

        //
        $urlData = 'chxt='.implode(',', array_keys($axesData)).'&';

        return $urlData;
    }

    /**
     * @param  Axis\AxisCollection $axisCollection
     * @return int;
     */
    protected function countTheFuckingAxis(Axis\AxisCollection $axisCollection = null)
    {
        if ($axisCollection == null) {
            return 0;
        }

        return $axisCollection->count();
    }

    /**
     * Suddenly this isn't going to work
     *
     * @param  Axis\AxisCollection $axisCollection
     * @return string
     */
    protected function renderAxisCollection(Axis\AxisCollection $axisCollection = null)
    {
        if ($axisCollection === null) {
            return '';
        }

        return 'hi';
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

    /**
     * @param  BaseChart $chart
     * @return string
     */
    public function render(BaseChart $chart)
    {
        $url = self::BASE_URL;

        $url .= $this->renderType($chart->getType());
        $url .= $this->renderSize($chart->getSize());
        $url .= $this->renderMargin($chart->getMargin());
        $url .= $this->renderChartLegend($chart->getLegend());
        $url .= $this->renderTitle($chart->getTitle());
        $url .= $this->renderAxesCollection($chart->getAxesCollection());

        // DATA SETS
        // So there's several elements that might rely on a dataset
        // Start with a loop then refactor
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
