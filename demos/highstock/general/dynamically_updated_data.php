<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart(Highchart::HIGHSTOCK);

$chart->chart->renderTo = "container";

$chart->chart->events->load = new HighchartJsExpr(
    "function() {
    var series = this.series[0];
    setInterval(function() {
        var x = (new Date()).getTime(), // current time
        y = Math.round(Math.random() * 100);
        series.addPoint([x, y], true, true);
    }, 1000); }");

$chart->rangeSelector->buttons = array(
    array(
        'type' => "minute",
        'count' => 1,
        'text' => "1M"
    ),
    array(
        'type' => "minute",
        'count' => 5,
        'text' => "5M"
    ),
    array(
        'type' => "all",
        'text' => "All"
    )
);

$chart->rangeSelector->inputEnabled = false;
$chart->rangeSelector->selected = 0;
$chart->title->text = "Live random data";
$chart->exporting->enabled = false;

$chart->series[] = array(
    'name' => "Random data",
    'data' => new HighchartJsExpr(
        "(function() {
    var data = [], time = (new Date()).getTime(), i;

    for( i = -999; i <= 0; i++) {
        data.push([
          time + i * 1000,
          Math.round(Math.random() * 100)
        ]);
    }
    return data;
  })()")
);

?>

<html>
    <head>
        <title>Dynamically updated data</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
        <?php
        $option = new HighchartOption();
        $option->global->useUTC = false;
        echo Highchart::setOptions($option);
        echo $chart->render("chart");
        ?>
        </script>
    </body>
</html>