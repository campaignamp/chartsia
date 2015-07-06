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

    protected function renderType($type = NULL)
    {
        if ($type === NULL) {
            return '';
        } else {
            return 'cht='.$type.'&';
        }
    }

    protected function renderSize(Config\Size $size = NULL)
    {
        if ($size === NULL) {
            return '';
        } else {
            return 'chs='.implode('x', $size->getDimensions()).'&';
        }
    }

    protected function renderMargin(Config\Margin $margin = NULL)
    {
        if ($margin !== NULL) {
            return 'chma='.implode(',', $margin->getDimensions()).'&';
        }

        return '';
    }

    protected function renderLegendLabels(array $legendLabels = [])
    {
        if ( ! empty($legendLabels)) {
            return 'chdl='.implode('|', $legendLabels).'&';
        }

        return '';
    }

    protected function renderLineColors(array $lineColors = [])
    {
        if ( ! empty($lineColors)) {
            return 'chco='.implode(',', $lineColors).'&';
        }

        return '';
    }

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

    // Still not sure of best way to actually handle this - to reliably type hint, I
    // need to be sure that getLegend() will always return a legend
    protected function renderChartLegend(Config\Legend $chartLegend = NULL)
    {
        if ($chartLegend !== NULL) {
            //chdlp=<opt_position>|<opt_label_order>
            return 'chdls='.$chartLegend->getColor()->getColor().','.$chartLegend->getFontSize().'&';
        }

        return '';
    }

    public function renderElements(array $elements = [])
    {
        $urlData = '';

        // SOME ELEMENT
        foreach ($elements as $chartElement) {
//             $urlData .= $chartElement->getKey().'='.$chartElement->render().'&';
        }

        return $urlData;
    }

    public function render(BaseChart $chart)
    {
        $url = self::BASE_URL;

        $url .= $this->renderType($chart->getType());
        $url .= $this->renderSize($chart->getSize());
        $url .= $this->renderMargin($chart->getMargin());
        $url .= $this->renderChartLegend($chart->getLegend());
        $url .= $this->renderTitle($chart->getTitle());
        $url .= $this->renderElements($chart->getElements());

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
        $url .= 'chd=t:'.implode('|', $data).'&';

        $url .= $this->renderLineColors($lineColors);
        $url .= $this->renderLegendLabels($legendLabels);

        return $url;
    }
}
