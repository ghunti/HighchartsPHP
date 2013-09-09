<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart = array(
    'renderTo' => 'container',
    'type' => 'waterfall'
);
$chart->title->text = 'Highcharts Waterfall';
$chart->xAxis->type = 'category';
$chart->xAxis->title->text = 'USD';
$chart->legend->enabled = false;
$chart->tooltip->pointFormat = '<b>${point.y:,.2f}</b> USD';
$chart->series = array(
    array(
        'upColor' => new HighchartJsExpr('Highcharts.getOptions().colors[2]'),
        'color' => new HighchartJsExpr('Highcharts.getOptions().colors[3]'),
        'data' => array(
            array(
                'name' => 'Start',
                'y' => 120000
            ),
            array(
                'name' => 'Product Revenue',
                'y' => 569000
            ),
            array(
                'name' => 'Service Revenue',
                'y' => 231000
            ),
            array(
                'name' => 'Positive Balance',
                'isIntermediateSum' => true,
                'color' => new HighchartJsExpr('Highcharts.getOptions().colors[1]')
            ),
            array(
                'name' => 'Fixed Costs',
                'y' => -342000
            ),
            array(
                'name' => 'Variable Costs',
                'y' => -233000
            ),
            array(
                'name' => 'Balance',
                'isSum' => true,
                'color' => new HighchartJsExpr('Highcharts.getOptions().colors[1]')
            )
        ),
        'dataLabels' => array(
            'enabled' => true,
            'formatter' => new HighchartJsExpr("function () {
                    return Highcharts.numberFormat(this.y / 1000, 0, ',') + 'k';
                }"
            ),
            'style' => array(
                'color' => '#FFFFFF',
                'fontWeight' => 'bold',
                'textShadow' => '0px 0px 3px black'
            )
        ),
        'pointPadding' => 0
    )
);
?>

<html>
    <head>
        <title>Waterfall</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>