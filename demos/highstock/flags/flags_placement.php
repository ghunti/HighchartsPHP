<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart(Highchart::HIGHSTOCK);

$chart->chart->renderTo = "container";
$chart->rangeSelector->selected = 1;
$chart->title->text = "USD to EUR exchange rate";
$chart->yAxis->title->text = "Exchange rate";

$chart->series[] = array(
    'name' => "USD to EUR",
    'data' => new HighchartJsExpr("data"),
    'id' => "dataseries",
    'tooltip' => array(
        'valueDecimals' => 4
    )
);

$chart->series[] = array(
    'type' => "flags",
    'name' => "Flags on series",
    'data' => array(
        array(
            'x' => new HighchartJsExpr("Date.UTC(2011, 1, 14)"),
            'title' => "On series"
        ),
        array(
            'x' => new HighchartJsExpr("Date.UTC(2011, 3, 28)"),
            'title' => "On series"
        )
    ),
    'onSeries' => "dataseries",
    'shape' => "squarepin"
);

$chart->series[] = array(
    'type' => "flags",
    'name' => "Flags on axis",
    'data' => array(
        array(
            'x' => new HighchartJsExpr("Date.UTC(2011, 2, 1)"),
            'title' => "On axis"
        ),
        array(
            'x' => new HighchartJsExpr("Date.UTC(2011, 3, 1)"),
            'title' => "On axis"
        )
    ),
    'shape' => "squarepin"
);
?>

<html>
    <head>
        <title>Flags placement</title>
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