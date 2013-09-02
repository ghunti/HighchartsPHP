<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart(Highchart::HIGHSTOCK);

$chart->chart->renderTo = "container";

$chart->chart->events->load = new HighchartJsExpr(
    "function(chart) {
    this.setTitle(null, {
        text: 'Built chart at '+ (new Date() - start) +'ms' }); }");

$chart->chart->zoomType = "x";

$chart->rangeSelector->buttons[] = array(
    'type' => "day",
    'count' => 3,
    'text' => "3d"
);

$chart->rangeSelector->buttons[] = array(
    'type' => "week",
    'count' => 1,
    'text' => "1w"
);

$chart->rangeSelector->buttons[] = array(
    'type' => "month",
    'count' => 1,
    'text' => "1m"
);

$chart->rangeSelector->buttons[] = array(
    'type' => "month",
    'count' => 6,
    'text' => "6m"
);

$chart->rangeSelector->buttons[] = array(
    'type' => "year",
    'count' => 1,
    'text' => "1y"
);

$chart->rangeSelector->buttons[] = array(
    'type' => "all",
    'text' => "All"
);

$chart->rangeSelector->selected = 3;
$chart->yAxis->title->text = "Temperature (°C)";
$chart->title->text = "Hourly temperatures in Vik i Sogn, Norway, 2004-2010";
$chart->subtitle->text = "Built chart at...";

$chart->series[] = array(
    'name' => "Temperature",
    'data' => new HighchartJsExpr("data"),
    'pointStart' => new HighchartJsExpr("Date.UTC(2004, 3, 1)"),
    'pointInterval' => 3600 * 1000,
    'tooltip' => array(
        'valueDecimals' => 1,
        'valueSuffix' => "°C"
    )
);
?>

<html>
    <head>
        <title>52000 points with data grouping</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=large-dataset.json&callback=?', function(data) {

                // Create a timer
                var start = + new Date();
                <?php
                echo $chart->render("chart1");
                ?>
            });
        </script>
    </body>
</html>