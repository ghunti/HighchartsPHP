<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = 'container';
$chart->chart->type = 'spline';
$chart->chart->inverted = true;
$chart->chart->width = 500;
$chart->chart->style->margin = '0 auto';
$chart->title->text = 'Atmosphere Temperature by Altitude';
$chart->subtitle->text = 'According to the Standard Atmosphere Model';
$chart->xAxis->reversed = false;
$chart->xAxis->title->enabled = true;
$chart->xAxis->title->text = 'Altitude';
$chart->xAxis->labels->formatter = new HighchartJsExpr("function() { return this.value +'km'; }");
$chart->xAxis->maxPadding = 0.05;
$chart->xAxis->showLastLabel = true;
$chart->yAxis->title->text = 'Temperature';
$chart->yAxis->labels->formatter = new HighchartJsExpr("function() { return this.value + '°'; }");
$chart->yAxis->lineWidth = 2;
$chart->yAxis->showFirstLabel = false;
$chart->legend->enabled = false;
$chart->tooltip->formatter = new HighchartJsExpr("function() { return ''+ this.x +' km: '+ this.y +'°C';}");

$chart->plotOptions->spline->marker->enable = false;
$chart->series[]->name = 'Temperature';
$chart->series[0]->data = array(
    array(
        0,
        15
    ),
    array(
        10,
        - 50
    ),
    array(
        20,
        - 56.5
    ),
    array(
        30,
        - 46.5
    ),
    array(
        40,
        - 22.1
    ),
    array(
        50,
        - 2.5
    ),
    array(
        60,
        - 27.7
    ),
    array(
        70,
        - 55.7
    ),
    array(
        80,
        - 76.5
    )
);

?>

<html>
    <head>
        <title>Spline with inverted axes</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>
