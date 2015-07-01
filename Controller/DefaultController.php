<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Outspaced\GoogleChartMakerBundle\Chart\Component;

use Outspaced\GoogleChartMakerBundle\Chart\Charts;
use Outspaced\GoogleChartMakerBundle\Chart\Config;
use Outspaced\GoogleChartMakerBundle\Chart\DataSet;
use Outspaced\GoogleChartMakerBundle\Chart\Element;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="tester")
     */
    public function testAction()
    {
        $title = new Config\Title();
        $title->setTitle('Wahey what a chart')
            ->setColor(new Component\Color('00FF00'));

        $customAxisLabel = (new Element\CustomAxisLabel())
            ->add('x')
            ->add('y')
            ->add('z');

        $size = (new Config\Size())
            ->setHeight(800)
            ->setWidth(300);

        $margin = new Config\Margin(50, 80, 20, 100);

        $legend = (new Config\Legend())
            ->setPosition('up')
            ->setFontSize(23)
            ->setColor(new Component\Color('FFFF44'));

        $chart = (new Charts\LineChart())
            ->setTitle($title)
            ->setSize($size)
            ->setMargin($margin)
            ->addElement($customAxisLabel)
            ->setLegend($legend);

        $dataSet = (new DataSet\DataSet())
            ->addData(10)
            ->addData(50)
            ->addData(60)
            ->addData(90)
            ->setColor(new Component\Color('FF0000'))
            ->setLegend(new DataSet\Legend('Set #1'));

        $dataSet2 = (new DataSet\DataSet())
            ->setData([40, 70, 10, 100])
            ->setColor(new Component\Color('0000FF'))
            ->setLegend(new DataSet\Legend('Set 2'));

        /*
        // Start off with an array, consider class afterwards
        $chart->addData([10, 50, 60, 90, 150, 20]);
        */

        $chart->addDataSet($dataSet)
            ->addDataSet($dataSet2);

        /*
         * UP NEXT
         *
         * Need to make the rendering happen from a dataset
         *
         */

//         $renderedChart = $chart->render();
//         dump($renderedChart);

        $renderer = new \Outspaced\GoogleChartMakerBundle\Chart\Renderer\Image($chart);

        $renderedChart = $renderer->render($chart);

        dump($renderedChart);

        // this is the basic goal
        // http://chart.googleapis.com/chart?cht=lc&chs=250x100&chd=t:27,25,90,50&chxl=x|y|z

        return $this->render('chart/index.html.twig', ['chart_url' => $renderedChart]);
    }


}
