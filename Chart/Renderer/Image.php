<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\Renderer;

use Outspaced\GoogleChartMakerBundle\Chart\Charts\BaseChart;
use Outspaced\GoogleChartMakerBundle\Chart\Config;

/**
 * This library has been deprecated by Google, although the API is still available
 */
class Image
{
    /**
     * @var string
     */
    const BASE_URL = 'http://chart.googleapis.com/chart?';

    protected function renderType($type=NULL)
    {
        if ($type === NULL) {
            return '';
        } else {
            return 'cht='. $type .'&';
        }
    }

    protected function renderSize(array $size=[])
    {
        if (empty($size)) {
            return '';
        } else {
            return 'chs='.implode('x', $size).'&';
        }
    }

    protected function renderMargins(array $margins=[])
    {
        if ( ! empty($margins)) {
            return 'chma='.implode(',', $margins).'&';
        }

        return '';
    }

    protected function renderLegendLabels(array $legendLabels=[])
    {
        if ( ! empty($legendLabels)) {
            return 'chdl='. implode('|', $legendLabels) .'&';
        }

        return '';
    }

    protected function renderLineColors(array $lineColors=[])
    {
        if ( ! empty($lineColors)) {
            return 'chco='. implode(',', $lineColors) .'&';
        }

        return '';
    }

    protected function renderTitle($title, $color='')
    {
        $url = 'chtt='. urlencode($title) .'&';

        if ( ! empty($color)) {
            $url .= 'chts='. $color .'&';
        }

        return $url;
    }

    // Still not sure of best way to actually handle this - to reliably type hint, I
    // need to be sure that getLegend() will always return a legend
    protected function renderChartLegend(Config\Legend $chartLegend=NULL)
    {
        if ($chartLegend !== NULL) {
            //chdlp=<opt_position>|<opt_label_order>
            return 'chdls='.$chartLegend->getColor()->getColor().','.$chartLegend->getFontSize().'&';
        }

        return '';
    }

    public function render(BaseChart $chart)
    {
        $url = self::BASE_URL;

        $url .= $this->renderType($chart->getType());
        $url .= $this->renderSize($chart->getSize()->getDimensions());

        if ($chart->getMargin()) {
            $url .= $this->renderMargins($chart->getMargin()->getDimensions());
        }

        if ($chart->getLegend()) {
            $url .= $this->renderChartLegend($chart->getLegend());
        }

        // TITLE
        if ($title = $chart->getTitle()) {
            $url .= $this->renderTitle($title->getTitle(), $title->getColor()->getColor());
        }

        // SOME ELEMENT
        foreach ($chart->getElements() as $chartElement) {
            $url .= $chartElement->getKey() . '=' . $chartElement->render() .'&';
        }

        // DATA SETS
        // So there's several elements that might rely on a dataset
        // Start with a loop then refactor
        $data = [];
        $lineColors = [];
        $legendLabels = [];

        foreach ($chart->getDataSets() as $dataSet) {

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
        $url .= 'chd=t:'. implode('|', $data) .'&';

        $url .= $this->renderLineColors($lineColors);
        $url .= $this->renderLegendLabels($legendLabels);

        return $url;
    }
}
