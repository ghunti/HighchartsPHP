<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart(Highchart::HIGHSTOCK);

$chart->chart->renderTo = "container";
$chart->rangeSelector->selected = 1;
$chart->title->text = "USD to EUR exchange rate";
$chart->tooltip->style->width = "200px";
$chart->tooltip->valueDecimals = 4;
$chart->yAxis->title->text = "Exchange rate";

$chart->series[] = array(
    'name' => "USD to EUR",
    'data' => new HighchartJsExpr("data"),
    'id' => "dataseries"
);

$chart->series[1]->type = "flags";

$chart->series[1]->data[] = array(
    'x' => new HighchartJsExpr("Date.UTC(2011, 3, 25)"),
    'title' => "H",
    'text' => "Euro Contained by Channel Resistance"
);

$chart->series[1]->data[] = array(
    'x' => new HighchartJsExpr("Date.UTC(2011, 3, 28)"),
    'title' => "G",
    'text' => "EURUSD: Bulls Clear Path to 1.50 Figure"
);

$chart->series[1]->data[] = array(
    'x' => new HighchartJsExpr("Date.UTC(2011, 4, 4)"),
    'title' => "F",
    'text' => "EURUSD: Rate Decision to End Standstill"
);

$chart->series[1]->data[] = array(
    'x' => new HighchartJsExpr("Date.UTC(2011, 4, 5)"),
    'title' => "E",
    'text' => "EURUSD: Enter Short on Channel Break"
);

$chart->series[1]->data[] = array(
    'x' => new HighchartJsExpr("Date.UTC(2011, 4, 6)"),
    'title' => "D",
    'text' => "Forex: U.S. Non-Farm Payrolls Expand 244K, U.S. Dollar Rally Cut Short By Risk Appetite"
);

$chart->series[1]->data[] = array(
    'x' => new HighchartJsExpr("Date.UTC(2011, 4, 6)"),
    'title' => "C",
    'text' => "US Dollar: Is This the Long-Awaited Recovery or a Temporary Bounce?"
);

$chart->series[1]->data[] = array(
    'x' => new HighchartJsExpr("Date.UTC(2011, 4, 9)"),
    'title' => "B",
    'text' => "EURUSD: Bearish Trend Change on Tap?"
);

$chart->series[1]->onSeries = "dataseries";
$chart->series[1]->shape = "circlepin";
$chart->series[1]->width = 16;

?>

<html>
    <head>
        <title>Flags marking events</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=usdeur.json&callback=?', function(data) {
                // create the chart
                <?php echo $chart->render("chart"); ?>;
            });
        </script>
    </body>
</html>