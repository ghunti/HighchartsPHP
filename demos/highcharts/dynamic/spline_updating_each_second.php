<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "spline";
$chart->chart->marginRight = 10;

$chart->chart->events->load = new HighchartJsExpr(
    "function() {
    var series = this.series[0];
    setInterval(function() {
        var x = (new Date()).getTime(),
            y = Math.random();
            series.addPoint([x, y], true, true);
    }, 1000); }");

$chart->title->text = "Live random data";
$chart->xAxis->type = "datetime";
$chart->xAxis->tickPixelInterval = 150;
$chart->yAxis->title->text = "Value";

$chart->yAxis->plotLines[] = array(
    'value' => 0,
    'width' => 1,
    'color' => "#808080"
);

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.series.name +'</b><br/>'+
    Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
    Highcharts.numberFormat(this.y, 2); }");

$chart->legend->enabled = false;
$chart->exporting->enabled = false;
$chart->series[0]->name = "Random data";

$chart->series[0]->data = new HighchartJsExpr(
    "(function() {
    var data = [],
        time = (new Date()).getTime(),
        i;

    for (i = -19; i <= 0; i++) {
        data.push({
            x: time + i * 1000,
            y: Math.random()
        });
    }
    return data; })()");

$globalOptions = new HighchartOption();
$globalOptions->global->useUTC = false;
?>

<html>
    <head>
    <title>Spline updating each second</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>