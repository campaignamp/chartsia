<?php

namespace Outspaced\ChartsiaBundle\Chart\Renderer;

use Outspaced\ChartsiaBundle\Chart\Charts;
use Outspaced\ChartsiaBundle\Chart\Config;
use Outspaced\ChartsiaBundle\Chart\Component;
use Outspaced\ChartsiaBundle\Chart\DataSet;
use Outspaced\ChartsiaBundle\Chart\DataSet\DataSetCollection;

class JavaScript
{
    /**
     * @param BaseChart $chart
     * @param \Twig_Environment $engine
     */
    public function renderWithTwig(Charts\BaseChart $chart, \Twig_Environment $engine)
    {
        $vars = [
            'title' => $this->renderTitle($chart->getTitle()),
            'title_color' => $this->renderTitleColor($chart->getTitle()),

            'chart_height' => $this->renderChartHeight($chart->getSize()),
            'chart_width'  => $this->renderChartWidth($chart->getSize()),

            'data_sets' => $this->renderDataSets($chart->getDataSetCollection()),
        ];

        $return = $engine->render(
            'OutspacedChartsiaBundle:Charts:javascript.html.twig',
            $vars
        );

        return $return;
    }

    protected function renderTitle(Config\Title $title = null)
    {
        if ($title === null) {
            return '';
        }

        return $title->getTitle();
    }

    protected function renderTitleColor(Config\Title $title = null)
    {
        if ($title === null) {
            return '';
        }

        return $this->renderColor($title->getColor());
    }

    protected function renderColor(Component\Color $color = null)
    {
        if ($color === null) {
            return '';
        }

        return $color->getColor();
    }

    protected function renderChartHeight(Config\Size $size = null)
    {
        if ($size === null) {
            return '';
        }

        return $size->getHeight();
    }

    protected function renderChartWidth(Config\Size $size = null)
    {
        if ($size === null) {
            return '';
        }

        return $size->getWidth();
    }

    /**
     * This will transform the datasets into an array
     *
     * @param array $dataSets
     */
    protected function renderDataSets(DataSet\DataSetCollection $dataSetCollection = null)
    {
        if ($dataSetCollection === null) {
            return [];
        }

        $return = [];

        if ($legends = $this->renderDataSetLegends($dataSetCollection)) {
            $return[] = $legends;
        }

        // Convert to arrays
        $max = 0;
        $dataSetsArrays = [];
        foreach ($dataSetCollection as $dataSet) {
            $max = max([count($dataSet->getData()), $max]);

            $dataSetsArrays[] = $dataSet->getData();
        }

        $restructuredDataSetsArrays = [];

        // Restructure the datasets so that corresponding values are in the same subarray
        foreach ($dataSetsArrays as $i => $dataSetsArray) {
            for ($i = 0; $i < $max; $i++) {

                if ( ! isset($restructuredDataSetsArrays[$i])) {
                    $restructuredDataSetsArrays[$i] = [''];
                }

                $restructuredDataSetsArrays[$i][] = $dataSetsArray[$i];
            }
        }

        // Add the headers before returning
        return array_merge($return, $restructuredDataSetsArrays);
    }

    protected function renderDataSetLegends(DataSet\DataSetCollection $dataSets = null) {
        if ($dataSets === null) {
            return [];
        }

        $legends = [''];
        foreach ($dataSets as $dataSet) {
            $legends[] = $this->renderDataSetLegend($dataSet->getLegend());
        }

        if ( ! array_filter($legends)) {
            return [];
        }

        return $legends;
    }

    protected function renderDataSetLegend(DataSet\Legend $legend = null)
    {
        if ($legend === null) {
            return '';
        }

        return $legend->getLabel();

    }
}
