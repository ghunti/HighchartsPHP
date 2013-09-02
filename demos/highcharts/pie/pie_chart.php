<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->plotBackgroundColor = null;
$chart->chart->plotBorderWidth = null;
$chart->chart->plotShadow = false;
$chart->title->text = "Browser market shares at a specific website, 2010";

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';}");

$chart->plotOptions->pie->allowPointSelect = 1;
$chart->plotOptions->pie->cursor = "pointer";
$chart->plotOptions->pie->dataLabels->enabled = 1;
$chart->plotOptions->pie->dataLabels->color = "#000000";
$chart->plotOptions->pie->dataLabels->connectorColor = "#000000";

$chart->plotOptions->pie->dataLabels->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %'; }");

$chart->series[] = array(
    'type' => "pie",
    'name' => "Browser share",
    'data' => array(
        array(
            "Firefox",
            45
        ),
        array(
            "IE",
            26.8
        ),
        array(
            'name' => 'Chrome',
            'y' => 12.8,
            'sliced' => true,
            'selected' => true
        ),
        array(
            "Safari",
            8.5
        ),
        array(
            "Opera",
            6.2
        ),
        array(
            "Others",
            0.7
        )
    )
);
?>

<html>
    <head>
    <title>Pie chart</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>