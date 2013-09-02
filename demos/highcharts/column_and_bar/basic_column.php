<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->chart->renderTo = "container";
$chart->chart->type = "column";
$chart->title->text = "Monthly Average Rainfall";
$chart->subtitle->text = "Source: WorldClimate.com";

$chart->xAxis->categories = array(
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec"
);

$chart->yAxis->min = 0;
$chart->yAxis->title->text = "Rainfall (mm)";
$chart->legend->layout = "vertical";
$chart->legend->backgroundColor = "#FFFFFF";
$chart->legend->align = "left";
$chart->legend->verticalAlign = "top";
$chart->legend->x = 100;
$chart->legend->y = 70;
$chart->legend->floating = 1;
$chart->legend->shadow = 1;

$chart->tooltip->formatter = new HighchartJsExpr("function() {
    return '' + this.x +': '+ this.y +' mm';}");

$chart->plotOptions->column->pointPadding = 0.2;
$chart->plotOptions->column->borderWidth = 0;

$chart->series[] = array(
    'name' => "Tokyo",
    'data' => array(
        49.9,
        71.5,
        106.4,
        129.2,
        144.0,
        176.0,
        135.6,
        148.5,
        216.4,
        194.1,
        95.6,
        54.4
    )
);

$chart->series[] = array(
    'name' => "New York",
    'data' => array(
        83.6,
        78.8,
        98.5,
        93.4,
        106.0,
        84.5,
        105.0,
        104.3,
        91.2,
        83.5,
        106.6,
        92.3
    )
);

$chart->series[] = array(
    'name' => "London",
    'data' => array(
        48.9,
        38.8,
        39.3,
        41.4,
        47.0,
        48.3,
        59.0,
        59.6,
        52.4,
        65.2,
        59.3,
        51.2
    )
);

$chart->series[] = array(
    'name' => "Berlin",
    'data' => array(
        42.4,
        33.2,
        34.5,
        39.7,
        52.6,
        75.5,
        57.4,
        60.4,
        47.6,
        39.1,
        46.8,
        51.1
    )
);

?>

<html>
    <head>
    <title>Basic column</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>