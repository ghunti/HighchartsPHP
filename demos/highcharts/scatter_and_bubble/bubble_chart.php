<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart->renderTo = 'container';
$chart->chart->type = 'bubble';
$chart->chart->zoomType = 'xy';
$chart->title->text = 'Highcharts Bubbles';

$chart->series = array(
    array(
        'data' => array(
            array(97, 36, 79),
            array(94, 74, 60),
            array(68, 76, 58),
            array(64, 87, 56),
            array(68, 27, 73),
            array(74, 99, 42),
            array(7, 93, 87),
            array(51, 69, 40),
            array(38, 23, 33),
            array(57, 86, 31)
        )
    ),
    array(
        'data' => array(
            array(25, 10, 87),
            array(2, 75, 59),
            array(11, 54, 8),
            array(86, 55, 93),
            array(5, 3, 58),
            array(90, 63, 44),
            array(91, 33, 17),
            array(97, 3, 56),
            array(15, 67, 48),
            array(54, 25, 81)
        )
    ),
    array(
        'data' => array(
            array(47, 47, 21),
            array(20, 12, 4),
            array(6, 76, 91),
            array(38, 30, 60),
            array(57, 98, 64),
            array(61, 17, 80),
            array(83, 60, 13),
            array(67, 78, 75),
            array(64, 12, 10),
            array(30, 77, 82)
        )
    )
);
?>

<html>
    <head>
        <title>Bubble chart</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>