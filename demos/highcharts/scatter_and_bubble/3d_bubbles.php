<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart->renderTo = 'container';
$chart->chart->type = 'bubble';
$chart->chart->plotBorderWidth = 1;
$chart->chart->zoomType = 'xy';
$chart->title->text = 'Highcharts bubbles with radial gradient fill';
$chart->xAxis->gridLineWidth = 1;
$chart->yAxis->startOnTick = false;
$chart->yAxis->endOnTick = false;

$chart->series = array(
    array(
        'data' => array(
            array(9, 81, 63),
            array(98, 5, 89),
            array(51, 50, 73),
            array(41, 22, 14),
            array(58, 24, 20),
            array(78, 37, 34),
            array(55, 56, 53),
            array(18, 45, 70),
            array(42, 44, 28),
            array(3, 52, 59),
            array(31, 18, 97),
            array(79, 91, 63),
            array(93, 23, 23),
            array(44, 83, 22)
        ),
        'marker' => array(
            'fillColor' => array(
                'radialGradient' => array(
                    'cx' => 0.4,
                    'cy' => 0.3,
                    'r' => 0.7
                ),
                'stops' => array(
                    array(0, 'rgba(255,255,255,0.5)'),
                    array(1, 'rgba(69,114,167,0.5)')
                )
            )
        )
    ),
    array(
        'data' => array(
            array(42, 38, 20),
            array(6, 18, 1),
            array(1, 93, 55),
            array(57, 2, 90),
            array(80, 76, 22),
            array(11, 74, 96),
            array(88, 56, 10),
            array(30, 47, 49),
            array(57, 62, 98),
            array(4, 16, 16),
            array(46, 10, 11),
            array(22, 87, 89),
            array(57, 91, 82),
            array(45, 15, 98)
        ),
        'marker' => array(
            'fillColor' => array(
                'radialGradient' => array(
                    'cx' => 0.4,
                    'cy' => 0.3,
                    'r' => 0.7
                ),
                'stops' => array(
                    array(0, 'rgba(255,255,255,0.5)'),
                    array(1, 'rgba(170,70,67,0.5)')
                )
            )
        )
    )
);
?>

<html>
    <head>
        <title>3D bubbles</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>