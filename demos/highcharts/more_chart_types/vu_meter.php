<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart = array(
    'type' => 'gauge',
    'plotBorderWidth' => 1,
    'plotBackgroundColor' => array(
        'linearGradient' => array(
            'x1' => 0,
            'y1' => 0,
            'x2' => 0,
            'y2' => 1
        ),
        'stops' => array(
            array(0, '#FFF4C6'),
            array(0.3, '#FFFFFF'),
            array(1, '#FFF4C6'),
        )
    ),
    'plotBackgroundImage' => null,
    'height' => 200
);
$chart->title->text = 'VU meter';
$chart->pane = array(
    array(
        'startAngle' => -45,
        'endAngle' => 45,
        'background' => null,
        'center' => array('25%', '145%'),
        'size' => 300
    ),
    array(
        'startAngle' => -45,
        'endAngle' => 45,
        'background' => null,
        'center' => array('75%', '145%'),
        'size' => 300
    )
);
$chart->yAxis = array(
    array(
        'min' => -20,
        'max' => 6,
        'minorTickPosition' => 'outside',
        'tickPosition' => 'outside',
        'labels' => array(
            'rotation' => 'auto',
            'distance' => 20
        ),
        'plotBands' => array(
            array(
                'from' => 0,
                'to' => 6,
                'color' => '#C02316',
                'innerRadius' => '100%',
                'outerRadius' => '105%'
            )
        ),
        'pane' => 0,
        'title' => array(
            'text' => 'VU<br/><span style="font-size:8px">Channel A</span>',
            'y' => -40
        )
    ),
    array(
        'min' => -20,
        'max' => 6,
        'minorTickPosition' => 'outside',
        'tickPosition' => 'outside',
        'labels' => array(
            'rotation' => 'auto',
            'distance' => 20
        ),
        'plotBands' => array(
            array(
                'from' => 0,
                'to' => 6,
                'color' => '#C02316',
                'innerRadius' => '100%',
                'outerRadius' => '105%'
            )
        ),
        'pane' => 1,
        'title' => array(
            'text' => 'VU<br/><span style="font-size:8px">Channel B</span>',
            'y' => -40
        )
    )
);
$chart->plotOptions->gauge->dataLabels->enabled = false;
$chart->plotOptions->gauge->dial->radius = '100%';
$chart->series = array(
    array(
        'data' => array(-20),
        'yAxis' => 0
    ),
    array(
        'data' => array(-20),
        'yAxis' => 1
    )
);

?>

<html>
    <head>
        <title>Vu meter</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            $('#container').highcharts(<?php echo $chart->renderOptions();?>,
                // Let the music play
                function(chart) {
                    setInterval(function() {
                        var left = chart.series[0].points[0],
                            right = chart.series[1].points[0],
                            leftVal, 
                            inc = (Math.random() - 0.5) * 3;
                
                        leftVal =  left.y + inc;
                        rightVal = leftVal + inc / 3;
                        if (leftVal < -20 || leftVal > 6) {
                            leftVal = left.y - inc;
                        }
                        if (rightVal < -20 || rightVal > 6) {
                            rightVal = leftVal;
                        }
                
                        left.update(leftVal, false);
                        right.update(rightVal, false);
                        chart.redraw();
                
                    }, 500);
                }
            );
        </script>
    </body>
</html>