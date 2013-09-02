<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "column";
$chart->chart->margin = array(
    50,
    50,
    100,
    80
);
$chart->title->text = "World's largest cities per 2008";

$chart->xAxis->categories = array(
    'Tokyo',
    'Jakarta',
    'New York',
    'Seoul',
    'Manila',
    'Mumbai',
    'Sao Paulo',
    'Mexico City',
    'Dehli',
    'Osaka',
    'Cairo',
    'Kolkata',
    'Los Angeles',
    'Shanghai',
    'Moscow',
    'Beijing',
    'Buenos Aires',
    'Guangzhou',
    'Shenzhen',
    'Istanbul'
);

$chart->xAxis->labels->rotation = - 45;
$chart->xAxis->labels->align = "right";
$chart->xAxis->labels->style->font = "normal 13px Verdana, sans-serif";
$chart->yAxis->min = 0;
$chart->yAxis->title->text = "Population (millions)";
$chart->legend->enabled = false;

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.x +'</b><br/>'+
    'Population in 2008: '+ Highcharts.numberFormat(this.y, 1) +
    ' millions';}");

$chart->series[] = array(
    'name' => 'Population',
    'data' => array(
        34.4,
        21.8,
        20.1,
        20,
        19.6,
        19.5,
        19.1,
        18.4,
        18,
        17.3,
        16.8,
        15,
        14.7,
        14.5,
        13.3,
        12.8,
        12.4,
        11.8,
        11.7,
        11.2
    ),
    'dataLabels' => array(
        'enabled' => true,
        'rotation' => - 90,
        'color' => '#FFFFFF',
        'align' => 'right',
        'x' => - 3,
        'y' => 10,
        'formatter' => new HighchartJsExpr(
            "function() {
                                                  return this.y;}"),
        'style' => array(
            'font' => 'normal 13px Verdana, sans-serif'
        )
    )
);
?>

<html>
    <head>
    <title>Column with rotated labels</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>