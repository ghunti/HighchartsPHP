<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart->renderTo = "container";
$chart->chart->plotBackgroundColor = null;
$chart->chart->plotBorderWidth = null;
$chart->chart->plotShadow = false;
$chart->title->text = "Browser market shares at a specific website, 2010";
$chart->tooltip->pointFormat = '{series.name}: <b>{point.percentage:.1f}%</b>';
$chart->subtitle->text = "Observed in Vik i Sogn, Norway, 2009";
$chart->xAxis->categories = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
$chart->yAxis->title->text = 'Temperature ( °C )';
$chart->plotOptions->pie = array(
    'allowPointSelect' => true,
    'cursor' => 'pointer',
    'dataLabels' => array(
        'enabled' => true,
        'color' => '#000000',
        'connectorColor' => '#000000',
        'formatter' => new HighchartJsExpr("function () {
            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %'; }")
    )
);

$chart->series[] = array(
    'type' => 'pie',
    'name' => 'Browser share',
    'data' => array(
        array('Firefox', 45.0),
        array('IE', 26.8),
        array(
            'name' => 'Chrome',
            'y' => 12.8,
            'sliced' => true,
            'selected' => true
        ),
        array('Safari', 8.5),
        array('Opera', 6.2),
        array('Others', 0.7)
    )
);
?>

<html>
    <head>
        <title>Pie with gradient fill</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            // Radialize the colors
            Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
                return {
                    radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
                    stops: [
                        [0, color],
                        [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                    ]
                };
            });
            <?php echo $chart->render("chart1"); ?>
        </script>
    </body>
</html>