<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->title->text = "Logarithmic axis demo";
$chart->xAxis->tickInterval = 1;
$chart->yAxis->type = "logarithmic";
$chart->yAxis->minorTickInterval = 0.1;
$chart->tooltip->headerFormat = "<b>{series.name}</b><br />";
$chart->tooltip->pointFormat = "x = {point.x}, y = {point.y}";
$chart->series[] = array(
    'data' => array(
        1,
        2,
        4,
        8,
        16,
        32,
        64,
        128,
        256,
        512
    ),
    'pointStart' => 1
);
?>

<html>
    <head>
        <title>Logarithmic axis</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>