<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->xAxis->min = - 0.5;
$chart->xAxis->max = 5.5;
$chart->yAxis->min = 0;
$chart->title->text = "Scatter plot with regression line";

$chart->series[] = array(
    'type' => "line",
    'name' => "Regression Line",
    'data' => array(
        array(
            0,
            1.11
        ),
        array(
            5,
            4.51
        )
    ),
    'marker' => array(
        'enabled' => false
    ),
    'states' => array(
        'hover' => array(
            'lineWidth' => 0
        )
    ),
    'enableMouseTracking' => false
);

$chart->series[] = array(
    'type' => "scatter",
    'name' => "Observations",
    'data' => array(
        1,
        1.5,
        2.8,
        3.5,
        3.9,
        4.2
    ),
    'marker' => array(
        'radius' => 4
    )
);
?>

<html>
    <head>
    <title>Scatter with regression line</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>