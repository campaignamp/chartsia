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
     * @param Charts\BaseChart $chart
     * @param \Twig_Environment $engine
     */
    public function renderWithTwig(Charts\BaseChart $chart, \Twig_Environment $engine)
    {
        $vars = [
            'title' => $this->renderTitle($chart->getTitle()),
            'title_color' => $this->renderTitleColor($chart->getTitle()),

            'chart_height' => $this->renderChartHeight($chart->getSize()),
            'chart_width'  => $this->renderChartWidth($chart->getSize()),

            'chart_legend' => $this->renderChartLegend($chart->getLegend()),

            'data_sets' => $this->renderDataSets($chart->getDataSetCollection()),
        ];

        $return = $engine->render(
            'OutspacedChartsiaBundle:Charts:javascript.html.twig',
            $vars
        );

        return $return;
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

        return $title->getTitle();
    }

    /**
     * @param  Config\Title $title
     * @return string
     */
    protected function renderTitleColor(Config\Title $title = null)
    {
        if ($title === null) {
            return '';
        }

        return $this->renderColor($title->getColor());
    }

    /**
     * @param  Component\Color $color
     * @return string
     */
    protected function renderColor(Component\Color $color = null)
    {
        if ($color === null) {
            return '';
        }

        return $color->getColor();
    }

    /**
     * @param  Config\Size $size
     * @return string
     */
    protected function renderChartHeight(Config\Size $size = null)
    {
        if ($size === null) {
            return '';
        }

        return $size->getHeight();
    }

    /**
     * @param  Config\Size $size
     * @return string
     */
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
     * @param DataSet\DataSetCollection $dataSetCollection
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

                if (!isset($restructuredDataSetsArrays[$i])) {
                    $restructuredDataSetsArrays[$i] = [''];
                }

                $restructuredDataSetsArrays[$i][] = $dataSetsArray[$i];
            }
        }

        // Add the headers before returning
        return array_merge($return, $restructuredDataSetsArrays);
    }

    /**
     * @param  DataSet\DataSetCollection $dataSets
     * @return array
     */
    protected function renderDataSetLegends(DataSet\DataSetCollection $dataSets = null)
    {
        if ($dataSets === null) {
            return [];
        }

        $legends = [''];

        foreach ($dataSets as $dataSet) {
            $legends[] = $this->renderDataSetLegend($dataSet->getLegend());
        }

        // If the array doesn't have any non-empty elements, then return an empty array
        if (!array_filter($legends)) {
            return [];
        }

        return $legends;
    }

    /**
     * @param  DataSet\Legend $legend
     * @return string
     */
    protected function renderDataSetLegend(DataSet\Legend $legend = null)
    {
        if ($legend === null) {
            return '';
        }

        return $legend->getLabel();
    }

    protected function renderChartLegend(Config\Legend $legend = null)
    {
        // hmmm is this right?
        if ($legend === null) {
            return [
                'color' => ''
            ];
        }

        return [
            'color' => $this->renderColor($legend->getColor())
        ];
    }
}
