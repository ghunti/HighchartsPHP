<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "column";
$chart->title->text = "Stacked column chart";
$chart->xAxis->categories = array(
    'Apples',
    'Oranges',
    'Pears',
    'Grapes',
    'Bananas'
);
$chart->yAxis->min = 0;
$chart->yAxis->title->text = "Total fruit consumption";
$chart->yAxis->stackLabels->enabled = 1;
$chart->yAxis->stackLabels->style->fontWeight = "bold";
$chart->yAxis->stackLabels->style->color = new HighchartJsExpr(
    "(Highcharts.theme && Highcharts.theme.textColor) || 'gray'");
$chart->legend->align = "right";
$chart->legend->x = - 100;
$chart->legend->verticalAlign = "top";
$chart->legend->y = 20;
$chart->legend->floating = 1;
$chart->legend->backgroundColor = new HighchartJsExpr(
    "(Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white'");
$chart->legend->borderColor = "#CCC";
$chart->legend->borderWidth = 1;
$chart->legend->shadow = false;

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.x +'</b><br/>'+
    this.series.name +': '+ this.y +'<br/>'+
    'Total: '+ this.point.stackTotal;}");

$chart->plotOptions->column->stacking = "normal";
$chart->plotOptions->column->dataLabels->enabled = 1;
$chart->plotOptions->column->dataLabels->color = new HighchartJsExpr(
    "(Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'");

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
    <title>Stacked column</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>