<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "areaspline";
$chart->title->text = "Average fruit consumption during one week";
$chart->legend->layout = "vertical";
$chart->legend->align = "left";
$chart->legend->verticalAlign = "top";
$chart->legend->x = 150;
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
$chart->xAxis->plotBands = array(
    'from' => 4.5,
    'to' => 6.5,
    'color' => "rgba(68, 170, 213, .2)"
);
$chart->yAxis->title->text = "Fruit units";
$chart->tooltip->formatter = new HighchartJsExpr("function() { return ''+ this.x +': '+ this.y +' units'; }");
$chart->credits->enabled = true;
$chart->plotOptions->areaspline->fillOpacity = 0.5;
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
        <title>Area spline</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>