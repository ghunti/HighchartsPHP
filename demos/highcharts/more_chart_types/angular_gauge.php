<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart = array(
    'type' => 'gauge',
    'plotBackgroundColor' => null,
    'plotBackgroundImage' => null,
    'plotBorderWidth' => 0,
    'plotShadow' => false
);
$chart->title->text = 'Speedometer';
$chart->pane->startAngle = -150;
$chart->pane->endAngle = 150;
$chart->background = array(
    array(
        'backgroundColor' => array(
            'linearGradient' => array(
                'x1' => 0,
                'y1' => 0,
                'x2' => 0,
                'y2' => 1
            ),
            'stops' => array(
                array(0, '#FFF'),
                array(1, '#333')
            )
        ),
        'borderWidth' => 0,
        'outerRadius' => '109%'
    ),
    array(
        'backgroundColor' => array(
            'linearGradient' => array(
                'x1' => 0,
                'y1' => 0,
                'x2' => 0,
                'y2' => 1
            ),
            'stops' => array(
                array(0, '#333'),
                array(1, '#FFF')
            )
        ),
        'borderWidth' => 1,
        'outerRadius' => '107%'
    ),
    array(
        'backgroundColor' => '#DDD',
        'borderWidth' => 0,
        'outerRadius' => '105%',
        'innerRadius' => '103%'
    )
);
$chart->yAxis = array(
    'min' => 0,
    'max' => 200,
    'minorTickInterval' => 'auto',
    'minorTickWidth' => 1,
    'minorTickLength' => 10,
    'minorTickPosition' => 'inside',
    'minorTickColor' => '#666',
    'tickPixelInterval' => 30,
    'tickWidth' => 2,
    'tickPosition' => 'inside',
    'tickLength' => 10,
    'tickColor' => '#666',
    'labels' => array(
        'step' => 2,
        'rotation' => 'auto'
    ),
    'title' => array(
        'text' => 'km/h'
    ),
    'plotBands' => array(
        array(
            'from' => 0,
            'to' => 120,
            'color' => '#55BF3B'
        ),
        array(
            'from' => 120,
            'to' => 160,
            'color' => '#DDDF0D'
        ),
        array(
            'from' => 160,
            'to' => 200,
            'color' => '#DF5353'
        )
    )
);
$chart->series[] = array(
    'name' => 'Speed',
    'data' => array(80),
    'tooltip' => array(
        'valueSuffix' => 'km/h'
    )
);

?>

<html>
    <head>
        <title>Angular gauge</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            $('#container').highcharts(<?php echo $chart->renderOptions();?>, 
            // Add some life
            function (chart) {
                if (!chart.renderer.forExport) {
                    setInterval(function () {
                        var point = chart.series[0].points[0],
                            newVal,
                            inc = Math.round((Math.random() - 0.5) * 20);

                        newVal = point.y + inc;
                        if (newVal < 0 || newVal > 200) {
                            newVal = point.y - inc;
                        }

                        point.update(newVal);

                    }, 3000);
                }
            }
            );
        </script>
    </body>
</html>