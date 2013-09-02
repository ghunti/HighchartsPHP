<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart(Highchart::HIGHSTOCK);

$chart->chart->renderTo = "container";
$chart->rangeSelector->selected = 1;
$chart->title->text = "AAPL Stock Price";
$chart->scrollbar->barBackgroundColor = "gray";
$chart->scrollbar->barBorderRadius = 7;
$chart->scrollbar->barBorderWidth = 0;
$chart->scrollbar->buttonBackgroundColor = "gray";
$chart->scrollbar->buttonBorderWidth = 0;
$chart->scrollbar->buttonBorderRadius = 7;
$chart->scrollbar->trackBackgroundColor = "none";
$chart->scrollbar->trackBorderWidth = 1;
$chart->scrollbar->trackBorderRadius = 8;
$chart->scrollbar->trackBorderColor = "#CCC";

$chart->series[] = array(
    'name' => "AAPL Stock Price",
    'data' => new HighchartJsExpr("data"),
    'tooltip' => array(
        'valueDecimals' => 2
    )
);
?>

<html>
    <head>
        <title>Styled scrollbar</title>
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