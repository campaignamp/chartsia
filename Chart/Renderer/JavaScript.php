<?php

namespace Outspaced\ChartsiaBundle\Chart\Renderer;

use Outspaced\ChartsiaBundle\Chart\Charts;

class JavaScript
{
    /**
     * @param BaseChart $chart
     * @param \Twig_Environment $engine
     */
    public function renderWithTwig(Charts\BaseChart $chart, \Twig_Environment $engine)
    {
        $return = $engine->render(
            'OutspacedChartsiaBundle:Charts:javascript.html.twig',
            ['oi' => 'you']
        );

        return $return;
    }

}
