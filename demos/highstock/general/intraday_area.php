<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart(Highchart::HIGHSTOCK);

$chart->chart->renderTo = "container";
$chart->title->text = "AAPL stock price by minute";
$chart->xAxis->gapGridLineWidth = 0;

$chart->rangeSelector->buttons = array(
    array(
        'type' => "hour",
        'count' => 1,
        'text' => "1h"
    ),
    array(
        'type' => "day",
        'count' => 1,
        'text' => "1D"
    ),
    array(
        'type' => "all",
        'count' => 1,
        'text' => "All"
    )
);

$chart->rangeSelector->selected = 1;
$chart->rangeSelector->inputEnabled = false;

$chart->series[] = array(
    'name' => "AAPL",
    'type' => "area",
    'data' => new HighchartJsExpr("data"),
    'gapSize' => 5,
    'tooltip' => array(
        'valueDecimals' => 2
    ),
    'fillColor' => array(
        'linearGradient' => array(
            'x1' => 0,
            'y1' => 0,
            'x2' => 0,
            'y2' => 1
        ),
        'stops' => array(
            array(
                0,
                new HighchartJsExpr("Highcharts.getOptions().colors[0]")
            ),
            array(
                1,
                "rgba(0,0,0,0)"
            )
        )
    ),
    'threshold' => null
);

?>

<html>
    <head>
        <title>Intraday area</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=new-intraday.json&callback=?', function(data) {
                // create the chart
                <?php echo $chart->render("chart"); ?>;
            });
        </script>
    </body>
</html>