<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart(Highchart::HIGHSTOCK);

$chart->chart->renderTo = "container";
$chart->rangeSelector->selected = 4;

$chart->yAxis->labels->formatter = new HighchartJsExpr(
    "function() {
    return (this.value > 0 ? '+' : '') + this.value + '%'; }");

$chart->yAxis->plotLines[] = array(
    'value' => 0,
    'width' => 2,
    'color' => "silver"
);

$chart->plotOptions->series->compare = "percent";
$chart->tooltip->pointFormat = "<span style=\"color:{series.color}\">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>";
$chart->tooltip->valueDecimals = 2;
$chart->series = new HighchartJsExpr("seriesOptions");

?>

<html>
    <head>
        <title>Compare multiple series</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            var seriesOptions = [],
            yAxisOptions = [],
            seriesCounter = 0,
            names = ['MSFT', 'AAPL', 'GOOG'],
            colors = Highcharts.getOptions().colors;

            $.each(names, function(i, name) {
                $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename='+ name.toLowerCase() +'-c.json&callback=?', function(data) {

                    seriesOptions[i] = {
                      name: name,
                      data: data
                    };

                    // As we're loading the data asynchronously, we don't know what order it will arrive. So
                    // we keep a counter and create the chart when all the data is loaded.
                    seriesCounter++;

                    if (seriesCounter == names.length) {
                      createChart();
                    }
                });
            });

            // create the chart when all data is loaded
            function createChart() {
            <?php
            echo $chart->render("chart");
            ?>
            }
        </script>
    </body>
</html>