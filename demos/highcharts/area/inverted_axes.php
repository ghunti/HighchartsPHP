<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "area";
$chart->chart->inverted = 1;
$chart->title->text = "Average fruit consumption during one week";
$chart->subtitle->style->position = "absolute";
$chart->subtitle->style->right = "0px";
$chart->subtitle->style->bottom = "10px";
$chart->legend->layout = "vertical";
$chart->legend->align = "right";
$chart->legend->verticalAlign = "top";
$chart->legend->x = - 150;
$chart->legend->y = 100;
$chart->legend->floating = 1;
$chart->legend->borderWidth = 1;
$chart->legend->backgroundColor = "#FFFFFF";
$chart->xAxis->categories = array(
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday',
    'Sunday'
);
$chart->yAxis->title->text = "Number of units";
$chart->yAxis->labels->formatter = new HighchartJsExpr("function() { return this.value; }");
$chart->yAxis->min = 0;
$chart->tooltip->formatter = new HighchartJsExpr("function() { return ''+ this.x +': '+ this.y; }");
$chart->plotOptions->area->fillOpacity = 0.5;
$chart->series[] = array(
    'name' => 'John',
    'data' => array(
        3,
        4,
        3,
        5,
        4,
        10,
        12
    )
);
$chart->series[] = array(
    'name' => 'Jane',
    'data' => array(
        1,
        3,
        4,
        3,
        3,
        5,
        4
    )
);
?>

<html>
    <head>
        <title>Inverted axes</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>