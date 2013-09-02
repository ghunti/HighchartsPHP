<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "area";
$chart->title->text = "Historic and Estimated Worldwide Population Growth by Region";
$chart->subtitle->text = "Source: Wikipedia.org";
$chart->xAxis->categories = array(
    '1750',
    '1800',
    '1850',
    '1900',
    '1950',
    '1999',
    '2050'
);
$chart->xAxis->tickmarkPlacement = "on";
$chart->xAxis->title->enabled = false;
$chart->yAxis->title->text = "Billions";
$chart->yAxis->labels->formatter = new HighchartJsExpr("function() { return this.value / 1000; }");
$chart->tooltip->formatter = new HighchartJsExpr(
    "function() { return ''+
                                  this.x +': '+ Highcharts.numberFormat(this.y, 0, ',') +' millions';}");
$chart->plotOptions->area->stacking = "normal";
$chart->plotOptions->area->lineColor = "#666666";
$chart->plotOptions->area->lineWidth = 1;
$chart->plotOptions->area->marker->lineWidth = 1;
$chart->plotOptions->area->marker->lineColor = "#666666";

$chart->series[] = array(
    'name' => "Asia",
    'data' => array(
        502,
        635,
        809,
        947,
        1402,
        3634,
        5268
    )
);
$chart->series[] = array(
    'name' => "Africa",
    'data' => array(
        106,
        107,
        111,
        133,
        221,
        767,
        1766
    )
);
$chart->series[] = array(
    'name' => "Europe",
    'data' => array(
        163,
        203,
        276,
        408,
        547,
        729,
        628
    )
);
$chart->series[] = array(
    'name' => "America",
    'data' => array(
        18,
        31,
        54,
        156,
        339,
        818,
        1201
    )
);
$chart->series[] = array(
    'name' => "Oceania",
    'data' => array(
        2,
        2,
        2,
        6,
        13,
        30,
        46
    )
);

?>

<html>
    <head>
        <title>Stacked chart</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>