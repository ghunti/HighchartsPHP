<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart = array(
    'type' => 'gauge',
    'alignTicks' => false,
    'plotBackgroundColor' => null,
    'plotBackgroundImage' => null,
    'plotBorderWidth' => 0,
    'plotShadow' => false
);
$chart->title->text = 'Speedometer with dual axes';
$chart->pane->startAngle = -150;
$chart->pane->endAngle = 150;
$chart->yAxis = array(
    array(
        'min' => 0,
        'max' => 200,
        'lineColor' => '#339',
        'tickColor' => '#339',
        'minorTickColor' => '#339',
        'offset' => -25,
        'lineWidth' => 2,
        'labels' => array(
            'distance' => -20,
            'rotation' => 'auto'
        ),
        'tickLength' => 5,
        'minorTickLength' => 5,
        'endOnTick' => 'false'
    ),
    array(
        'min' => 0,
        'max' => 124,
        'tickPosition' => 'outside',
        'lineColor' => '#933',
        'lineWidth' => 2,
        'minorTickPosition' => 'outside',
        'tickColor' => '#933',
        'minorTickColor' => '#933',
        'tickLength' => 5,
        'minorTickLength' => 5,
        'labels' => array(
            'distance' => 12,
            'rotation' => 'auto'
        ),
        'offset' => -20,
        'endOnTick' => 'false'
    )
);
$chart->series[] = array(
    'name' => 'Speed',
    'data' => array(80),
    'dataLabels' => array(
        'formatter' => new HighchartJsExpr("function () {
            var kmh = this.y,
                mph = Math.round(kmh * 0.621);
            return '<span style=\"color:#339\">'+ kmh + ' km/h</span><br/>' +
                '<span style=\"color:#933\">' + mph + ' mph</span>'; }"
        ),
        'backgroundColor' => array(
            'linearGradient' => array(
                'x1' => 0,
                'y1' => 0,
                'x2' => 0,
                'y2' => 1
            ),
            'stops' => array(
                array(0, '#DDD'),
                array(1, '#FFF')
            )
        )
    ),
    'tooltip' => array(
        'valueSuffix' => 'km/h'
    )
);

?>

<html>
    <head>
        <title>Gauge with dual axes</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            $('#container').highcharts(<?php echo $chart->renderOptions();?>,
                // Add some life
                function(chart) {
                    setInterval(function() {
                        var point = chart.series[0].points[0],
                            newVal, inc = Math.round((Math.random() - 0.5) * 20);
                
                        newVal = point.y + inc;
                        if (newVal < 0 || newVal > 200) {
                            newVal = point.y - inc;
                        }
                
                        point.update(newVal);
                
                    }, 3000);
                }
            );
        </script>
    </body>
</html>