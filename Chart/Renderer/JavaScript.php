<?php

namespace Outspaced\ChartsiaBundle\Chart\Renderer;

use Outspaced\ChartsiaBundle\Chart\Charts;
use Outspaced\ChartsiaBundle\Chart\Config;

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
            'title_color' => $this->renderTitleColor($chart->getTitle())
        ];

        $return = $engine->render(
            'OutspacedChartsiaBundle:Charts:javascript.html.twig',
            $vars
        );

        return $return;
    }

    protected function renderTitle(Config\Title $title = NULL)
    {
        if ($title === NULL) {
            return '';
        }

        return $title->getTitle();
    }

    protected function renderTitleColor(Config\Title $title = NULL)
    {
        if ($title === NULL || $title->getColor() === NULL) {
            return '';
        }

        return $title->getColor()->getColor();
    }

}
