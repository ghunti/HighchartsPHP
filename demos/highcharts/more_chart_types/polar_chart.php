<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart->renderTo = 'container';
$chart->chart->polar = true;
$chart->title->text = 'Highcharts Polar Chart';
$chart->pane->startAngle = 0;
$chart->pane->endAngle = 360;
$chart->xAxis->tickInterval = 45;
$chart->xAxis->min = 0;
$chart->xAxis->max = 360;
$chart->xAxis->labels->formatter = new HighchartJsExpr("function () { return this.value + '°'; }");
$chart->yAxis->min = 0;
$chart->plotOptions->series->pointStart = 0;
$chart->plotOptions->series->pointInterval = 45;
$chart->plotOptions->column->pointPadding = 0;
$chart->plotOptions->column->groupPadding = 0;
$chart->series = array(
    array(
        'type' => 'column',
        'name' => 'Column',
        'data' => array(8, 7, 6, 5, 4, 3, 2, 1),
        'pointPlacement' => 'between'
    ),
    array(
        'type' => 'line',
        'name' => 'Line',
        'data' => array(1, 2, 3, 4, 5, 6, 7, 8)
    ),
    array(
        'type' => 'area',
        'name' => 'Area',
        'data' => array(1, 8, 2, 7, 3, 6, 4, 5)
    )
);
?>

<html>
    <head>
        <title>Polar chart</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>