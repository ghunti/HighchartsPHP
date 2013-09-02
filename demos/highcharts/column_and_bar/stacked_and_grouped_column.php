<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "column";
$chart->title->text = "Total fruit consumtion, grouped by gender";
$chart->xAxis->categories = array(
    'Apples',
    'Oranges',
    'Pears',
    'Grapes',
    'Bananas'
);
$chart->yAxis->allowDecimals = false;
$chart->yAxis->min = 0;
$chart->yAxis->title->text = "Number of fruits";
$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.x +'</b><br/>'+
    this.series.name +': '+ this.y +'<br/>'+
    'Total: '+ this.point.stackTotal;}");

$chart->plotOptions->column->stacking = "normal";

$chart->series[] = array(
    'name' => "John",
    'data' => array(
        5,
        3,
        4,
        7,
        2
    ),
    'stack' => 'male'
);

$chart->series[] = array(
    'name' => "Joe",
    'data' => array(
        3,
        4,
        4,
        2,
        5
    ),
    'stack' => 'male'
);

$chart->series[] = array(
    'name' => "Jane",
    'data' => array(
        2,
        5,
        6,
        2,
        1
    ),
    'stack' => 'female'
);

$chart->series[] = array(
    'name' => "Janet",
    'data' => array(
        3,
        0,
        4,
        4,
        3
    ),
    'stack' => 'female'
);
?>

<html>
    <head>
    <title>Stacked and grouped column</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>