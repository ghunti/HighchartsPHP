<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart(Highchart::HIGHSTOCK);

$chart->chart->renderTo = "container";
$chart->rangeSelector->selected = 1;
$chart->title->text = "USD to EUR exchange rate";
$chart->yAxis->title->text = "Exchange rate";

$chart->yAxis->plotBands[] = array(
    'from' => 0.6738,
    'to' => 0.7419,
    'color' => "rgba(68, 170, 213, 0.2)",
    'label' => array(
        'text' => "Last quarter's value range"
    )
);

$chart->series[] = array(
    'name' => "USD to EUR",
    'data' => new HighchartJsExpr("data"),
    'tooltip' => array(
        'valueDecimals' => 4
    )
);

?>

<html>
    <head>
        <title>Plot band on Y axis</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=usdeur.json&callback=?', function(data) {
                <?php echo $chart->render("chart"); ?>;
            });
        </script>
    </body>
</html>