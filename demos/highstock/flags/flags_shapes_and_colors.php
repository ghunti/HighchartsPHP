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
    'data' => array(
        array(
            'x' => new HighchartJsExpr("Date.UTC(2011, 1, 14)"),
            'title' => "A",
            'text' => "Shape: \"squarepin\""
        ),
        array(
            'x' => new HighchartJsExpr("Date.UTC(2011, 3, 28)"),
            'title' => "A",
            'text' => "Shape: \"squarepin\""
        )
    ),
    'onSeries' => "dataseries",
    'shape' => "squarepin",
    'width' => 16
);

$chart->series[] = array(
    'type' => "flags",
    'data' => array(
        array(
            'x' => new HighchartJsExpr("Date.UTC(2011, 2, 1)"),
            'title' => "B",
            'text' => "Shape: \"circlepin\""
        ),
        array(
            'x' => new HighchartJsExpr("Date.UTC(2011, 3, 1)"),
            'title' => "B",
            'text' => "Shape: \"circlepin\""
        )
    ),
    'shape' => "circlepin",
    'width' => 16
);

$chart->series[] = array(
    'type' => "flags",
    'data' => array(
        array(
            'x' => new HighchartJsExpr("Date.UTC(2011, 2, 10)"),
            'title' => "C",
            'text' => "Shape: \"flag\""
        ),
        array(
            'x' => new HighchartJsExpr("Date.UTC(2011, 3, 11)"),
            'title' => "C",
            'text' => "Shape: \"flag\""
        )
    ),
    'color' => "#5F86B3",
    'fillColor' => "#5F86B3",
    'onSeries' => "dataseries",
    'width' => 16,
    'style' => array(
        'color' => "white"
    ),
    'states' => array(
        'hover' => array(
            'fillColor' => "#395C84"
        )
    )
);
?>

<html>
    <head>
        <title>Flags shapes and colors</title>
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