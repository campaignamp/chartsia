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
        $chartData = $chart->getData();
        
        dump($chartData);
        
        $url = self::BASE_URL;
        
        // Now it needs to run through the data returned by getData() and form it into a URL
        
        // TYPE
        $url .= 'cht='. $chart->getType() .'&';

        // SIZE
        $url .= 'chs='. implode('x', $chart->getSize()) .'&';
        
        // SOME ELEMENT
        foreach ($chart->getElements() as $chartElement) {
            $url .= $chartElement->getKey() . '=' . $chartElement->render() .'&';
        }

        $url .= 'chd=t:'. implode(',', $chart->getData()) .'&';
        
        return $url;
    }
}
