<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "bar";
$chart->title->text = "Historic World Population by Region";
$chart->subtitle->text = "Source: Wikipedia.org";
$chart->xAxis->categories = array(
    'Africa',
    'America',
    'Asia',
    'Europe',
    'Oceania'
);
$chart->xAxis->title->text = null;
$chart->yAxis->min = 0;
$chart->yAxis->title->text = "Population (millions)";
$chart->yAxis->title->align = "high";

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    return '' + this.series.name +': '+ this.y +' millions';}");

$chart->plotOptions->bar->dataLabels->enabled = 1;
$chart->legend->layout = "vertical";
$chart->legend->align = "right";
$chart->legend->verticalAlign = "top";
$chart->legend->x = - 100;
$chart->legend->y = 100;
$chart->legend->floating = 1;
$chart->legend->borderWidth = 1;
$chart->legend->backgroundColor = "#FFFFFF";
$chart->legend->shadow = 1;
$chart->credits->enabled = false;

$chart->series[] = array(
    'name' => "Year 1800",
    'data' => array(
        107,
        31,
        635,
        203,
        2
    )
);

$chart->series[] = array(
    'name' => "Year 1900",
    'data' => array(
        133,
        156,
        947,
        408,
        6
    )
);

$chart->series[] = array(
    'name' => "Year 2008",
    'data' => array(
        973,
        914,
        4054,
        732,
        34
    )
);

?>

<html>
    <head>
        <title>Basic bar</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>