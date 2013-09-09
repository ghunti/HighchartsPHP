<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart->renderTo = "container";
$chart->chart->type = "columnrange";
$chart->chart->inverted = true;
$chart->title->text = "Temperature variation by month";
$chart->subtitle->text = "Observed in Vik i Sogn, Norway, 2009";
$chart->xAxis->categories = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
$chart->yAxis->title->text = 'Temperature ( °C )';
$chart->tooltip->valueSuffix = 'ºC';

$chart->plotOptions->dataLabels = array(
    'enabled' => true,
    'formatter' => new HighchartJsExpr("function () { return this.y + '°C'; }")
);
$chart->legend->enabled = false;

$chart->series[] = array(
    'name' => 'Temperatures',
    'data' => array(
        array(-9.7, 9.4),
        array(-8.7, 6.5),
        array(-3.5, 9.4),
        array(-1.4, 19.9),
        array(0.0, 22.6),
        array(2.9, 29.5),
        array(9.2, 30.7),
        array(7.3, 26.5),
        array(4.4, 18.0),
        array(-3.1, 11.4),
        array(-5.2, 10.4),
        array(-13.5, 9.8)
    )
);
?>

<html>
    <head>
        <title>Column range</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>