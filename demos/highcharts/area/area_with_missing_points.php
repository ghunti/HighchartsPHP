<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "area";
$chart->chart->spacingBottom = 30;
$chart->title->text = "Fruit consumption *";
$chart->subtitle->text = "* Jane's banana consumption is unknown";
$chart->subtitle->floating = true;
$chart->subtitle->align = "right";
$chart->subtitle->verticalAlign = "bottom";
$chart->subtitle->y = 15;
$chart->legend->layout = 'vertical';
$chart->legend->align = 'left';
$chart->legend->verticalAlign = 'top';
$chart->legend->x = 150;
$chart->legend->y = 100;
$chart->legend->floating = true;
$chart->legend->borderWidth = 1;
$chart->legend->backgroundColor = '#FFFFFF';
$chart->xAxis->categories = array(
    'Apples',
    'Pears',
    'Oranges',
    'Bananas',
    'Grapes',
    'Plums',
    'Strawberries',
    'Raspberries'
);
$chart->yAxis->title->text = "Y-Axis";
$chart->yAxis->labels->formatter = new HighchartJsExpr("function() { return this.value; }");
$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
                              return '<b>'+ this.series.name +'</b><br/>'+
                              this.x +': '+ this.y; }");
$chart->plotOptions->area->fillOpacity = 0.5;
$chart->credits->enabled = false;
$chart->series[] = array(
    'name' => 'John',
    'data' => array(
        0,
        1,
        4,
        4,
        5,
        2,
        3,
        7
    )
);
$chart->series[] = array(
    'name' => 'Jane',
    'data' => array(
        1,
        0,
        3,
        null,
        3,
        1,
        2,
        1
    )
);
?>

<html>
    <head>
        <title>Area with missing points</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>