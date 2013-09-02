<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "spline";
$chart->title->text = "Monthly Average Temperature";
$chart->subtitle->text = "Source: WorldClimate.com";
$chart->xAxis->categories = array(
    'Jan',
    'Feb',
    'Mar',
    'Apr',
    'May',
    'Jun',
    'Jul',
    'Aug',
    'Sep',
    'Oct',
    'Nov',
    'Dec'
);
$chart->yAxis->title->text = "Temperature";
$chart->tooltip->crosshairs = 1;
$chart->tooltip->shared = 1;
$chart->plotOptions->spline->marker->radius = 4;
$chart->plotOptions->spline->marker->lineColor = "#666666";
$chart->plotOptions->spline->marker->lineWidth = 1;

$data = array(
    7.0,
    6.9,
    9.5,
    14.5,
    18.2,
    21.5,
    25.2,
    array(
        'y' => 26.5,
        'marker' => array(
            'symbol' => 'url(http://www.highcharts.com/demo/gfx/sun.png)'
        )
    ),
    23.3,
    18.3,
    13.9,
    9.6
);
$chart->series[] = array(
    'name' => "Tokyo",
    'marker' => array(
        'symbol' => "square"
    ),
    'data' => $data
);

$data = array(
    array(
        'y' => 3.9,
        'marker' => array(
            'symbol' => 'url(http://www.highcharts.com/demo/gfx/snow.png)'
        )
    ),
    4.2,
    5.7,
    8.5,
    11.9,
    15.2,
    17.0,
    16.6,
    14.2,
    10.3,
    6.6,
    4.8
);
$chart->series[] = array(
    'name' => "London",
    'marker' => array(
        'symbol' => "diamond"
    ),
    'data' => $data
);
?>

<html>
    <head>
        <title>Spline with symbols</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>
