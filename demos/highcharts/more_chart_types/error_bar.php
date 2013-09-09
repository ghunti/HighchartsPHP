<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart->renderTo = 'container';
$chart->chart->zoomType = 'xy';
$chart->title->text = 'Temperature vs Rainfall';
$chart->xAxis = array(
    array(
        'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')
    )
);
$chart->yAxis = array(
    array(
        'labels' => array(
            'formatter' => new HighchartJsExpr("function() { return this.value + '°C';}"),
            'style' => array('color'  => '#89A54E')
        ),
        'title' => array(
            'text' => 'Temperature',
                'style' => array('color' => '#89A54E')
        )
    ),
    array(
        'title' => array(
            'text' => 'Rainfall',
            'style' => array('color' => '#4572A7')
        ),
        'labels' => array(
            'formatter' => new HighchartJsExpr("function() { return this.value + ' mm';}"),
            'style' => array('color'  => '#4572A7')
        ),
        'opposite' => true
    )
);
$chart->tooltip->shared = true;
$chart->series = array(
    array(
        'name' => 'Rainfall',
        'color' => '#4572A7',
        'type' => 'column',
        'yAxis' => 1,
        'data' => array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4),
        'tooltip' => array(
            'pointFormat' => '<span style="font-weight: bold; color: {series.color}">'
                . '{series.name}</span>: <b>{point.y:.1f} mm</b> '
        )
    ),
    array(
        'name' => 'Rainfall error',
        'type' => 'errorbar',
        'yAxis' => 1,
        'data' => array(
            array(48, 51), 
            array(68, 73), 
            array(92, 110), 
            array(128, 136), 
            array(140, 150), 
            array(171, 179), 
            array(135, 143), 
            array(142, 149), 
            array(204, 220), 
            array(189, 199), 
            array(95, 110), 
            array(52, 56)
        ),
        'tooltip' => array(
            'pointFormat' => '(error range: {point.low}-{point.high} mm)<br/>'
        )
    ),
    array(
        'name' => 'Temperature',
        'color' => '#89A54E',
        'type' => 'spline',
        'data' => array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6),
        'tooltip' => array(
            'pointFormat' => '<span style="font-weight: bold; color: {series.color}">'
                . '{series.name}</span>: <b>{point.y:.1f}°C</b> '
        )
    ),
    array(
        'name' => 'Temperature error',
        'type' => 'errorbar',
        'data' => array(
            array(6, 8), 
            array(5.9, 7.6), 
            array(9.4, 10.4), 
            array(14.1, 15.9), 
            array(18.0, 20.1), 
            array(21.0, 24.0), 
            array(23.2, 25.3), 
            array(26.1, 27.8), 
            array(23.2, 23.9), 
            array(18.0, 21.1), 
            array(12.9, 14.0), 
            array(7.6, 10.0)
        ),
        'tooltip' => array(
            'pointFormat' => '(error range: {point.low}-{point.high}°C)<br/>'
        )
    )
);
?>

<html>
    <head>
        <title>Error bar</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>