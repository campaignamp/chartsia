<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Outspaced\ChartsiaBundle\Chart\Component;
use Outspaced\ChartsiaBundle\Chart\Charts;
use Outspaced\ChartsiaBundle\Chart\Config;
use Outspaced\ChartsiaBundle\Chart\DataSet;
use Outspaced\ChartsiaBundle\Chart\Renderer;
use Outspaced\ChartsiaBundle\Chart\Axis;

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

        $size = (new Config\Size())
            ->setHeight(300)
            ->setWidth(800);

        $margin = new Config\Margin(50, 80, 20, 100);

        $legend = (new Config\Legend())
            ->setPosition('up')
            ->setFontSize(23)
            ->setColor(new Component\Color('FFFF44'));

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

        $dataSetCollection = (new DataSet\DataSetCollection())
            ->add($dataSet)
            ->add($dataSet2);

        $bottomAxis = (new Axis\Axis())
            ->setLabel((new Axis\Label())->setLabel('I am the bottom'));

        $bottomAxisCollection = (new Axis\AxisCollection())
            ->add(new Axis\Axis())
            ->add($bottomAxis);

        $leftAxis = (new Axis\Axis())
            ->setLabel((new Axis\Label())->setLabel('Me lefty'));

        $leftAxisCollection = (new Axis\AxisCollection())
            ->add($leftAxis);

        $axisCollectionCollection = (new Axis\AxisCollectionCollection())
            ->setBottomAxisCollection($bottomAxisCollection)
            ->setLeftAxisCollection($leftAxisCollection);

        $chart = (new Charts\LineChart())
            ->setTitle($title)
            ->setSize($size)
            ->setMargin($margin)
            ->setLegend($legend)
            ->setDataSetCollection($dataSetCollection)
            ->setAxisCollectionCollection($axisCollectionCollection);

        $renderer = new Renderer\Image();

        $renderedChart = $renderer->render($chart);
        dump($renderedChart);


        $javaScriptRenderer = new Renderer\JavaScript();
        $javaScriptRenderedChart = $javaScriptRenderer->renderWithTwig($chart, $this->get('twig'));
        dump($javaScriptRenderedChart);

        // this is the basic goal
        // http://chart.googleapis.com/chart?cht=lc&chs=250x100&chd=t:27,25,90,50&chxl=x|y|z

        return $this->render('chart/index.html.twig', [
            'chart_url' => $renderedChart,
            'js_chart'  => $javaScriptRenderedChart
        ]);
    }


}
