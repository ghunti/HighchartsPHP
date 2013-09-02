<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart(Highchart::HIGHSTOCK);

$chart->chart->renderTo = "container";
$chart->title->text = "AAPL stock price by minute";

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
    'type' => "candlestick",
    'data' => new HighchartJsExpr("data"),
    'tooltip' => array(
        'valueDecimals' => 2
    )
);

?>

<html>
    <head>
        <title>Intraday candlestick</title>
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