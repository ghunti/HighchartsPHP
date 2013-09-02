<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->zoomType = "xy";
$chart->title->text = "Average Monthly Temperature and Rainfall in Tokyo";
$chart->subtitle->text = "Source: WorldClimate.com";

$chart->xAxis = array(
    array(
        'categories' => array(
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        )
    )
);

$leftYaxis = new HighchartOption();

$leftYaxis->labels->formatter = new HighchartJsExpr("function() {
    return this.value +'°C'; }");

$leftYaxis->labels->style->color = "#89A54E";
$leftYaxis->title->text = "Temperature";
$leftYaxis->title->style->color = "#89A54E";

$rightYaxis = new HighchartOption();
$rightYaxis->title->text = "Rainfall";
$rightYaxis->title->style->color = "#4572A7";

$rightYaxis->labels->formatter = new HighchartJsExpr("function() {
    return this.value +' mm'; }");

$rightYaxis->labels->style->color = "#4572A7";
$rightYaxis->opposite = 1;
$chart->yAxis = array(
    $leftYaxis,
    $rightYaxis
);

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    return '' + this.x +': '+ this.y +
    (this.series.name == 'Rainfall' ? ' mm' : '°C'); }");

$chart->legend->layout = "vertical";
$chart->legend->align = "left";
$chart->legend->x = 120;
$chart->legend->verticalAlign = "top";
$chart->legend->y = 100;
$chart->legend->floating = 1;
$chart->legend->backgroundColor = "#FFFFFF";

$chart->series[] = array(
    'name' => "Rainfall",
    'color' => "#4572A7",
    'type' => "column",
    'yAxis' => 1,
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
    'name' => "Temperature",
    'color' => "#89A54E",
    'type' => "spline",
    'data' => array(
        7.0,
        6.9,
        9.5,
        14.5,
        18.2,
        21.5,
        25.2,
        26.5,
        23.3,
        18.3,
        13.9,
        9.6
    )
);
?>

<html>
    <head>
    <title>Dual axes line and column</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>