<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart(Highchart::HIGHSTOCK);
$chart->includeExtraScripts();

$chart->chart->type = 'candlestick';
$chart->chart->zoomType = 'x';
$chart->navigator->adaptToUpdatedData = false;
$chart->navigator->series->data = new HighchartJsExpr('data');
$chart->scrollbar->liveRedraw = false;
$chart->title->text = 'AAPL history by the minute from 1998 to 2011';
$chart->subtitle->text = 'Displaying 1.7 million data points in Highcharts Stock by async server loading';
$chart->rangeSelector->buttons = array(
    array(
        'type' => 'hour',
        'count' => 1,
        'text' => '1h'
    ),
    array(
        'type' => 'day',
        'count' => 1,
        'text' => '1d'
    ),
    array(
        'type' => 'month',
        'count' => 1,
        'text' => '1m'
    ),
    array(
        'type' => 'year',
        'count' => 1,
        'text' => '1y'
    ),
    array(
        'type' => 'all',
        'text' => 'All'
    )
);
$chart->rangeSelector->inputEnabled = false;
$chart->rangeSelector->selected = 4;
$chart->xAxis->events->afterSetExtremes = new HighchartJsExpr('afterSetExtremes');
$chart->xAxis->minRange = 3600 * 1000;
$chart->series[] = array(
    'data' => new HighchartJsExpr('data'),
    'dataGrouping' => array('enabled' => false)
);
?>

<html>
    <head>
        <title>1.7 million points with async loading</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            $.getJSON('http://www.highcharts.com/samples/data/from-sql.php?callback=?', function(data) {

                // Add a null value for the end date 
                data = [].concat(data, [[Date.UTC(2011, 9, 14, 19, 59), null, null, null, null]]);
    
                // create the chart
                $('#container').highcharts('StockChart',<?php echo $chart->renderOptions(); ?>)}
            );
            /**
             * Load new data depending on the selected min and max
             */
            function afterSetExtremes(e) {

                var url,
                    currentExtremes = this.getExtremes(),
                    range = e.max - e.min;
                var chart = $('#container').highcharts();
                chart.showLoading('Loading data from server...');
                $.getJSON('http://www.highcharts.com/samples/data/from-sql.php?start='+ Math.round(e.min) +
                        '&end='+ Math.round(e.max) +'&callback=?', function(data) {

                    chart.series[0].setData(data);
                    chart.hideLoading();
                });
                
            }
        </script>
    </body>
</html>