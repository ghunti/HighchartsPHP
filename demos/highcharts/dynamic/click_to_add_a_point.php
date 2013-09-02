<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "scatter";
$chart->chart->margin = array(
    70,
    50,
    60,
    80
);

$chart->chart->events->click = new HighchartJsExpr(
    "function(e) {
    var x = e.xAxis[0].value,
        y = e.yAxis[0].value,
        series = this.series[0];
    series.addPoint([x, y]); }");

$chart->title->text = "User supplied data";
$chart->subtitle->text = "Click the plot area to add a point. Click a point to remove it.";
$chart->xAxis->minPadding = 0.2;
$chart->xAxis->maxPadding = 0.2;
$chart->xAxis->maxZoom = 60;
$chart->yAxis->title->text = "Value";
$chart->yAxis->minPadding = 0.2;
$chart->yAxis->maxPadding = 0.2;
$chart->yAxis->maxZoom = 60;

$chart->yAxis->plotLines[] = array(
    'value' => 0,
    'width' => 1,
    'color' => "#808080"
);

$chart->legend->enabled = false;
$chart->exporting->enabled = false;
$chart->plotOptions->series->lineWidth = 1;

$chart->plotOptions->series->point->events->click = new HighchartJsExpr(
    "function() {
    if (this.series.data.length > 1) this.remove(); }");

$chart->series[]->data = array(
    array(
        20,
        20
    ),
    array(
        80,
        80
    )
);
?>

<html>
    <head>
    <title>Click to add a point</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>