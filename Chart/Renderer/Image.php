<?php

namespace Outspaced\ChartsiaBundle\Chart\Renderer;

use Outspaced\ChartsiaBundle\Chart\Charts\BaseChart;
use Outspaced\ChartsiaBundle\Chart\Config;

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
    protected function renderType($type = NULL)
    {
        if ($type === NULL) {
            return '';
        } else {
            return 'cht='.$type.'&';
        }
    }


    /**
     * @param  Config\Size $size
     * @return string
     */
    protected function renderSize(Config\Size $size = NULL)
    {
        if ($size === NULL) {
            return '';
        }

        return 'chs='.implode('x', $size->getDimensions()).'&';
    }

    /**
     * @param Config\Margin $margin
     * @return string
     */
    protected function renderMargin(Config\Margin $margin = NULL)
    {
        if ($margin === NULL) {
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
    protected function renderTitle(Config\Title $title = NULL)
    {
        if ($title === NULL) {
            return '';
        }

        $url = 'chtt='.urlencode($title->getTitle()).'&';

        if ($title->getColor() !== NULL) {
            $url .= 'chts='.$title->getColor()->getColor().'&';
        }

        return $url;
    }

    /**
     * @param Config\Legend $chartLegend
     * @return string
     */
    protected function renderChartLegend(Config\Legend $chartLegend = NULL)
    {
        if ($chartLegend !== NULL) {
            return '';
        }

        //chdlp=<opt_position>|<opt_label_order>
        return 'chdls='.$chartLegend->getColor()->getColor().','.$chartLegend->getFontSize().'&';
    }

    /**
     * @param array $axes
     * @return string
     */
    public function renderAxes(array $axes = [])
    {
        $urlData = '';

        foreach ($axes as $index => $axis) {

            // Need to implement this - right now it does nothing
            $axisKeys = [
                'top' => 't',
                'bottom' => 'x',
                'left' => 'y',
                'right' => 'r'
            ];
        }

        return $urlData;
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
        $url .= $this->renderAxes($chart->getAxisCollection());

        // DATA SETS
        // So there's several elements that might rely on a dataset
        // Start with a loop then refactor
        $data = [];
        $lineColors = [];
        $legendLabels = [];

        foreach ($chart->getDataSetCollection() as $dataSet) {

            $data[] = implode(',', $dataSet->getData());

            // OK so how to handle the chart-specific elements?
            if ($dataSet->getColor()) {
                $lineColors[] = $dataSet->getColor()->getColor();
            }

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
