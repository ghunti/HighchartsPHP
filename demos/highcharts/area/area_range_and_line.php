<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';


$ranges = array(
    array(1246406400000, 14.3, 27.7),
    array(1246492800000, 14.5, 27.8),
    array(1246579200000, 15.5, 29.6),
    array(1246665600000, 16.7, 30.7),
    array(1246752000000, 16.5, 25.0),
    array(1246838400000, 17.8, 25.7),
    array(1246924800000, 13.5, 24.8),
    array(1247011200000, 10.5, 21.4),
    array(1247097600000, 9.2, 23.8),
    array(1247184000000, 11.6, 21.8),
    array(1247270400000, 10.7, 23.7),
    array(1247356800000, 11.0, 23.3),
    array(1247443200000, 11.6, 23.7),
    array(1247529600000, 11.8, 20.7),
    array(1247616000000, 12.6, 22.4),
    array(1247702400000, 13.6, 19.6),
    array(1247788800000, 11.4, 22.6),
    array(1247875200000, 13.2, 25.0),
    array(1247961600000, 14.2, 21.6),
    array(1248048000000, 13.1, 17.1),
    array(1248134400000, 12.2, 15.5),
    array(1248220800000, 12.0, 20.8),
    array(1248307200000, 12.0, 17.1),
    array(1248393600000, 12.7, 18.3),
    array(1248480000000, 12.4, 19.4),
    array(1248566400000, 12.6, 19.9),
    array(1248652800000, 11.9, 20.2),
    array(1248739200000, 11.0, 19.3),
    array(1248825600000, 10.8, 17.8),
    array(1248912000000, 11.8, 18.5),
    array(1248998400000, 10.8, 16.1),
);

$averages = array(
    array(1246406400000, 21.5),
    array(1246492800000, 22.1),
    array(1246579200000, 23),
    array(1246665600000, 23.8),
    array(1246752000000, 21.4),
    array(1246838400000, 21.3),
    array(1246924800000, 18.3),
    array(1247011200000, 15.4),
    array(1247097600000, 16.4),
    array(1247184000000, 17.7),
    array(1247270400000, 17.5),
    array(1247356800000, 17.6),
    array(1247443200000, 17.7),
    array(1247529600000, 16.8),
    array(1247616000000, 17.7),
    array(1247702400000, 16.3),
    array(1247788800000, 17.8),
    array(1247875200000, 18.1),
    array(1247961600000, 17.2),
    array(1248048000000, 14.4),
    array(1248134400000, 13.7),
    array(1248220800000, 15.7),
    array(1248307200000, 14.6),
    array(1248393600000, 15.3),
    array(1248480000000, 15.3),
    array(1248566400000, 15.8),
    array(1248652800000, 15.2),
    array(1248739200000, 14.8),
    array(1248825600000, 14.4),
    array(1248912000000, 15),
    array(1248998400000, 13.6)
);

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart->renderTo = "container";
$chart->title->text = "July temperatures";
$chart->xAxis->type = "datetime";
$chart->yAxis->title->text = null;
$chart->tooltip = array(
    'crosshairs' => true,
    'shared' => true,
    'valueSuffix' => 'ºC'
);
$chart->legend = new stdClass();
$chart->series[] = array(
    'name' => 'Temperatures',
    'data' => $averages,
    'zIndex' => 1,
    'marker' => array(
        'fillColor' => 'white',
        'lineWidth' => 2,
        'lineColor' => new HighchartJsExpr("Highcharts.getOptions().colors[0]"),
    )
);
$chart->series[] = array(
    'name' => 'Range',
    'data' => $ranges,
    'type' => 'arearange',
    'lineWidth' => 0,
    'linkedTo' => ':previous',
    'color' => new HighchartJsExpr("Highcharts.getOptions().colors[0]"),
    'fillOpacity' => 0.3,
    'zIndex' => 0
);
?>

<html>
    <head>
        <title>Area range and line</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>