<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart(Highchart::HIGHSTOCK);

$chart->chart->renderTo = "container";
$chart->rangeSelector->selected = 1;
$chart->title->text = "AAPL Stock Price";

$chart->series[] = array(
    'name' => "AAPL Stock Price",
    'data' => new HighchartJsExpr("data"),
    'marker' => array(
        'enabled' => 1,
        'radius' => 3
    ),
    'shadow' => 1,
    'tooltip' => array(
        'valueDecimals' => 2
    )
);

?>

<html>
    <head>
        <title>Line with markers and shadow</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=?', function(data) {
                <?php echo $chart->render("chart"); ?>;
            });
        </script>
    </body>
</html>