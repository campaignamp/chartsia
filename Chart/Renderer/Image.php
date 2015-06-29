<?php

namespace Outspaced\GoogleChartMakerBundle\Chart\Renderer;

use Outspaced\GoogleChartMakerBundle\Chart\Charts\BaseChart;

/**
 * @deprecated by Google, although the API is still available
 */
class Image
{
	/**
	 * @var string
	 */
	const BASE_URL = 'http://chart.googleapis.com/chart?';

    public function render(BaseChart $chart)
    {
        $url = self::BASE_URL;

        // Now it needs to run through the data returned by getData() and form it into a URL

        // TYPE
        $url .= 'cht='. $chart->getType() .'&';

        // SIZE
        $url .= 'chs='. implode('x', $chart->getSize()) .'&';

        // TITLE
        if ($title = $chart->getTitle()) {
            $url .= 'chtt='. urlencode($title->getTitle()) .'&';

            if ($title->getColor()) {
                $url .= 'chts='. $title->getColor()->getColor() .'&';
            }
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

        foreach ($chart->getDataSets() as $dataSet) {

            $data[] = implode(',', $dataSet->getData());

            // OK so how to handle the chart-specific elements?
            if ($dataSet->getColor()) {
                $lineColors[] = $dataSet->getColor()->getColor();
            }
        }

        $url .= 'chd=t:'. implode('|', $data) .'&';

        if ($lineColors) {
            $url .= 'chco='. implode(',', $lineColors) .'&';
        }

        return $url;
    }
}
