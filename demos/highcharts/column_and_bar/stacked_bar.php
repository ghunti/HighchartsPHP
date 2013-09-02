<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "bar";
$chart->title->text = "Stacked bar chart";
$chart->xAxis->categories = array(
    'Apples',
    'Oranges',
    'Pears',
    'Grapes',
    'Bananas'
);
$chart->yAxis->min = 0;
$chart->yAxis->title->text = "Total fruit consumption";

$chart->tooltip->formatter = new HighchartJsExpr("function() {
    return '' + this.series.name +': '+ this.y +'';}");

$chart->legend->backgroundColor = "#FFFFFF";
$chart->legend->reversed = 1;
$chart->plotOptions->series->stacking = "normal";

$chart->series[] = array(
    'name' => "John",
    'data' => array(
        5,
        3,
        4,
        7,
        2
    )
);

$chart->series[] = array(
    'name' => "Jane",
    'data' => array(
        2,
        2,
        3,
        2,
        1
    )
);

$chart->series[] = array(
    'name' => "Joe",
    'data' => array(
        3,
        4,
        4,
        2,
        5
    )
);
?>

<html>
    <head>
    <title>Stacked bar</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>