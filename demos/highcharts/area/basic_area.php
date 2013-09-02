<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "area";
$chart->title->text = "US and USSR nuclear stockpiles";
$chart->subtitle->text = "Source: <a href=\"http://thebulletin.metapress.com/content/c4120650912x74k7/fulltext.pdf\">thebulletin.metapress.com</a>";
$chart->xAxis->labels->formatter = new HighchartJsExpr("function() { return this.value;}");
$chart->yAxis->title->text = "Nuclear weapon states";
$chart->yAxis->labels->formatter = new HighchartJsExpr("function() { return this.value / 1000 +'k';}");
$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
                              return this.series.name +' produced <b>'+
                              Highcharts.numberFormat(this.y, 0) +'</b><br/>warheads in '+ this.x;}");
$chart->plotOptions->area->pointStart = 1940;
$chart->plotOptions->area->marker->enabled = false;
$chart->plotOptions->area->marker->symbol = "circle";
$chart->plotOptions->area->marker->radius = 2;
$chart->plotOptions->area->marker->states->hover->enabled = true;

$chart->series[] = array(
    'name' => 'USA',
    'data' => array(
        null,
        null,
        null,
        null,
        null,
        6,
        11,
        32,
        110,
        235,
        369,
        640,
        1005,
        1436,
        2063,
        3057,
        4618,
        6444,
        9822,
        15468,
        20434,
        24126,
        27387,
        29459,
        31056,
        31982,
        32040,
        31233,
        29224,
        27342,
        26662,
        26956,
        27912,
        28999,
        28965,
        27826,
        25579,
        25722,
        24826,
        24605,
        24304,
        23464,
        23708,
        24099,
        24357,
        24237,
        24401,
        24344,
        23586,
        22380,
        21004,
        17287,
        14747,
        13076,
        12555,
        12144,
        11009,
        10950,
        10871,
        10824,
        10577,
        10527,
        10475,
        10421,
        10358,
        10295,
        10104
    )
);

$chart->series[] = array(
    'name' => 'USSR/Russia',
    'data' => array(
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        5,
        25,
        50,
        120,
        150,
        200,
        426,
        660,
        869,
        1060,
        1605,
        2471,
        3322,
        4238,
        5221,
        6129,
        7089,
        8339,
        9399,
        10538,
        11643,
        13092,
        14478,
        15915,
        17385,
        19055,
        21205,
        23044,
        25393,
        27935,
        30062,
        32049,
        33952,
        35804,
        37431,
        39197,
        45000,
        43000,
        41000,
        39000,
        37000,
        35000,
        33000,
        31000,
        29000,
        27000,
        25000,
        24000,
        23000,
        22000,
        21000,
        20000,
        19000,
        18000,
        18000,
        17000,
        16000
    )
);
?>

<html>
    <head>
        <title>Basic area</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>