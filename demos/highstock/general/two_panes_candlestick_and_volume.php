<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart(Highchart::HIGHSTOCK);

$chart->chart->renderTo = "container";
$chart->chart->alignTicks = false;
$chart->rangeSelector->selected = 1;
$chart->title->text = "AAPL Historical";
$leftYaxis = new HighchartOption();
$leftYaxis->title->text = "OHLC";
$leftYaxis->height = 200;
$leftYaxis->lineWidth = 2;
$rightYaxis = new HighchartOption();
$rightYaxis->title->text = "Volume";
$rightYaxis->top = 300;
$rightYaxis->height = 100;
$rightYaxis->offset = 0;
$rightYaxis->lineWidth = 2;
$chart->yAxis = array(
    $leftYaxis,
    $rightYaxis
);

$chart->series[] = array(
    'type' => "candlestick",
    'name' => "AAPL",
    'data' => new HighchartJsExpr("ohlc"),
    'dataGrouping' => array(
        'units' => new HighchartJsExpr("groupingUnits")
    )
);

$chart->series[] = array(
    'type' => "column",
    'name' => "Volume",
    'data' => new HighchartJsExpr("volume"),
    'yAxis' => 1,
    'dataGrouping' => array(
        'units' => new HighchartJsExpr("groupingUnits")
    )
);
?>

<html>
    <head>
        <title>Two panes, candlestick and volume</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function(data) {

                // split the data set into ohlc and volume
                var ohlc = [],
                  volume = [],
                  dataLength = data.length;

                for (i = 0; i < dataLength; i++) {
                  ohlc.push([
                    data[i][0], // the date
                    data[i][1], // open
                    data[i][2], // high
                    data[i][3], // low
                    data[i][4] // close
                  ]);

                  volume.push([
                    data[i][0], // the date
                    data[i][5] // the volume
                  ])
                }

                // set the allowed units for data grouping
                var groupingUnits = [[
                  'week',                         // unit name
                  [1]                             // allowed multiples
                ], [
                  'month',
                  [1, 2, 3, 4, 6]
                ]];

                // create the chart
                chart = <?php echo $chart->render(); ?>;
            });
        </script>
    </body>
</html>