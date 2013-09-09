<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart = array(
    'renderTo' => 'container',
    'type' => 'funnel',
    'marginRight' => 100
);
$chart->title = array(
    'text' => 'Sales funnel',
    'x' => -50
);
$chart->plotOptions->series = array(
    'dataLabels' => array(
        'enabled' => true,
        'format' => '<b>{point.name}</b> ({point.y:,.0f})',
        'color' => 'black',
        'softConnector' => true
    ),
    'neckWidth' => '30%',
    'neckHeight' => '25%'
);
$chart->legend->enabled = false;
$chart->series = array(
        array(
                'name' => 'Unique users',
                'data' => array(
                        array('Website visits', 15654),
                        array('Downloads', 4064),
                        array('Requested price list', 1987),
                        array('Invoice sent', 976),
                        array('Finalized', 846)
                )
        )
);
?>

<html>
    <head>
        <title>Funnel chart</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
        <script src="http://code.highcharts.com/modules/funnel.js"></script>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>