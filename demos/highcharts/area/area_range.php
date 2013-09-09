<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart->type = "arearange";
$chart->chart->zoomType = "x";
$chart->title->text = "Temperature variation by day";
$chart->xAxis->type = "datetime";
$chart->yAxis->title->text = null;
$chart->tooltip = array(
    'crosshairs' => true,
    'shared' => true,
    'valueSuffix' => 'ºC'
);
$chart->legend->enabled = false;
$chart->series[] = array(
    'name' => 'Temperatures',
    'data' => new HighchartJsExpr('data')
);
?>

<html>
    <head>
        <title>Area range</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=range.json&callback=?', function(data) {
                $('#container').highcharts(<?php echo $chart->renderOptions(); ?>)});
        </script>
    </body>
</html>