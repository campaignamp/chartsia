<?php

namespace Outspaced\ChartsiaBundle\Chart\Renderer;

use Outspaced\ChartsiaBundle\Chart\Charts;
use Outspaced\ChartsiaBundle\Chart\Config;
use Outspaced\ChartsiaBundle\Chart\Component;
use Outspaced\ChartsiaBundle\Chart\Axis;
use Outspaced\ChartsiaBundle\Chart\Type;

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
     * @param Type\Type $type
     * @return string
     */
    protected function renderType(Type\Type $type = null)
    {
        if ($type === null) {
            return '';
        }

        switch ($type->getSlug()) {
            case 'line_chart':
                $typeName = 'lc';
                break;
            case 'bar_chart':
                $typeName = 'bhs';
                break;
            case 'pie_chart':
                $typeName = 'p';
                break;
            default:
                $typeName = '';
        }

        return 'cht=' . $typeName . '&';
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

        return 'chs=' . implode('x', $size->getDimensions()) . '&';
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

        return 'chma=' . implode(',', $margin->getDimensions()) . '&';
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

        return 'chdl=' . implode('|', $legendLabels) . '&';
    }

    /**
     * so LINE COLORS?  no, just colors, motherfucker!
     *
     * @param  array $lineColors
     * @return string
     */
    protected function renderLineColors(array $lineColors = [])
    {
        if (empty($lineColors)) {
            return '';
        }

        return 'chco=' . implode(',', $lineColors) . '&';
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

        $url = 'chtt=' . urlencode($title->getTitle()) . '&';

        if ($title->getColor() !== null) {
            $url .= 'chts=' . $title->getColor()->getColor() . '&';
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
        return 'chdls=' . $this->renderColor($chartLegend->getColor()) . ',' . $chartLegend->getFontSize() . '&';
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
     * @param Charts\Chart $chart
     * @return string
     */
    protected function renderAxes(Charts\Chart $chart)
    {
        $possibleAxisKeys = [
            't' => 'getTopAxis',
            'x' => 'getBottomAxis',
            'y' => 'getLeftAxis',
            'r' => 'getRightAxis'
        ];

        $actualAxes     = [];
        $positions      = [];
        $labels         = [];
        $axisColors     = [];
        $axisFontSizes  = [];
        $gridlines  = [
            'x' => [
                'step' => 0,
                'offset' => 0
            ],
            'y' => [
                'step' => 0,
                'offset' => 0
            ],
        ];

        foreach ($possibleAxisKeys as $possibleAxisKey => $method) {

            // eg getTopAxis, getLeftAxis
            if ($axis = $chart->{$method}()) {

                $actualAxes[] = $possibleAxisKey;

                // Label
                if ($labelTings = $axis->getLabels()) {

                    $labelTexts = [];
                    $positionTings = [];

                    foreach ($labelTings as $label) {
                        $labelTexts[] = urlencode($label->getLabel());
                        $positionTings[] = $label->getPosition();
                    }

                    if (array_filter($labelTexts)) {
                        
                        $filteredLabelTexts = [];
                        
                        foreach ($labelTexts as $text) {
                            // remove any unique numbering
                            $filteredLabelTexts[] = substr($text, strpos($text, '.'));
                        }
                        
                        $labels[$this->getCurrentKeyFromAxesArray($actualAxes)] = implode('|', $filteredLabelTexts);
                    }

                    if (array_filter($positionTings)) {
                        $positions[$this->getCurrentKeyFromAxesArray($actualAxes)] = implode(',', $positionTings);
                    }
                }

                // Title
                if ($title = $axis->getTitle()) {
                    $actualAxes[] = $possibleAxisKey;
                    $labels[$this->getCurrentKeyFromAxesArray($actualAxes)] = $title->getValue();
                    $positions[$this->getCurrentKeyFromAxesArray($actualAxes)] = $title->getPosition();
                }

                // Gridlines
                if (in_array($possibleAxisKey, ['x', 'y'])) {
                    if ($gridlinesTing = $axis->getGridlines()) {
                        $gridlines[$possibleAxisKey]['step'] = $gridlinesTing->getStepSize();
                        $gridlines[$possibleAxisKey]['offset'] = $gridlinesTing->getOffset();
                    } else {
                        $gridlines[$possibleAxisKey]['step'] = 0;
                        $gridlines[$possibleAxisKey]['offset'] = 0;
                    }
                }

                // Axis colouring
                if ($axisColor = $axis->getColor()) {
                    $axisColors[$this->getCurrentKeyFromAxesArray($actualAxes)] = $axisColor->getColor();
                }

                // Axis font sizes
                if ($fontSize = $axis->getFontSize()) {
                    $axisFontSizes[$this->getCurrentKeyFromAxesArray($actualAxes)] = $axis->getFontSize();
                }
            }
        }

        // Add the defined axes to the URL
        $urlData = 'chxt=' . implode(',', array_values($actualAxes)) . '&';

        // Add the defined labels to the URL
        if (!empty($labels)) {
            $urlData .= 'chxl=';

            foreach ($labels as $labelKey => $labelValue) {
                $urlData .= '|' . $labelKey . ':|' . $labelValue;
            }

            $urlData .= '&';
        }

        // Add the defined positions to the URL
        if (!empty($positions)) {
            $urlData .= 'chxp=';
            foreach ($positions as $positionKey => $positionValue) {
                $urlData .= $positionKey . ',' . $positionValue . '|';
            }
            $urlData = rtrim($urlData, "|");
            $urlData .= '&';
        }

        // Add the defined colours and font sizes to the URL
        if (!empty($axisColors) || !empty($axisFontSizes)) {
            $urlData .= 'chxs=';
            foreach ($axisColors as $axisColorKey => $axisColor) {

                if (isset($axisFontSizes[$axisColorKey])) {
                    $axisFontSize = ',' . $axisFontSizes[$axisColorKey];
                } else {
                    $axisFontSize = '';
                }

                $urlData .= $axisColorKey . 'N*s*,' . $axisColor . $axisFontSize . '|';
            }
            $urlData = rtrim($urlData, "|");
            $urlData .= '&';
        }

        // Add gridlines
        $urlData .= 'chg=' . $gridlines['x']['step'] . ',' .
            $gridlines['y']['step'] . ',' .
            '0,0,' .
            $gridlines['x']['offset'] . ',' .
            $gridlines['y']['offset'];

        $urlData .= '&';

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
    public function render(Charts\Chart $chart)
    {
        $url = self::BASE_URL;

        $url .= $this->renderType($chart->getType());
        $url .= $this->renderSize($chart->getSize());
        $url .= $this->renderMargin($chart->getMargin());
        $url .= $this->renderChartLegend($chart->getLegend());
        $url .= $this->renderTitle($chart->getTitle());
        $url .= $this->renderAxes($chart);

        // DATA SETS
        $data = [];
        $lineColors = [];
        $legendLabels = [];
        $colorCollections = [];

        foreach ($chart->getDataSetCollection() as $dataSet) {

            $data[] = implode(',', $dataSet->getData());

            // Line colours
            $lineColors[] = $this->renderColor($dataSet->getColor());

            if ($legend = $dataSet->getLegend()) {
                $legendLabels[] = urlencode($legend->getLabel());
            }

            // Colour collections
            // These refer to the colours of the data representation - ie the line/bar/pie slice
            if ($colorCollection = $dataSet->getColorCollection()) {

                $tmpColorCollection = [];

                foreach ($colorCollection as $dataSetColor) {
                    $tmpColorCollection[] = $this->renderColor($dataSetColor);
                }

                $colorCollections[] = implode('|', $tmpColorCollection);
            }

            if ($legend = $dataSet->getLegend()) {
                $legendLabels[] = urlencode($legend->getLabel());
            }

        }

        // Dataset data
        $url .= 'chd=t:' . implode('|', $data) . '&';

        $url .= $this->renderLineColors($lineColors);
        $url .= $this->renderLegendLabels($legendLabels);

        if (!empty($colorCollections)) {
            $url .= 'chco=' . implode(',', $colorCollections) . '&';
        }

        // Auto-scale?
        if ($this->isAutoScale($chart)) {
            $url .= 'chds=a&';
        }

        return $url;
    }

    /**
     * @param Charts\Chart $chart
     * @return boolean
     */
    protected function isAutoScale(Charts\Chart $chart)
    {
        if ($chart->isAutoScale()) {
            return true;
        }

        if ($leftAxis = $chart->getLeftAxis()) {
            if ($leftAxis->getAutoLabel()) {
                return true;
            }
        }

        return false;
    }
}
