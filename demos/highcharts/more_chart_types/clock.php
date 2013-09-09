<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();
$backgroundOptions = new HighchartOption();
$backgroundOptions->radiaGradient = array(
    'cx' => 0.5,
    'cy' => -0.4,
    'r' => 1.9
);
$backgroundOptions->stops = array(
    array(0.5, 'rgba(255, 255, 255, 0.2)'),
    array(0.5, 'rgba(200, 200, 200, 0.2)')
);

$chart->chart = array(
    'type' => 'gauge',
    'plotBackgroundColor' => null,
    'plotBackgroundImage' => null,
    'plotBorderWidth' => 0,
    'plotShadow' => false,
    'height' => 200
);
$chart->credits->enabled = false;
$chart->title->text = 'The Highcharts clock';
$chart->pane->background[] = array(
    new stdClass(),
    array('backgroundColor' => new HighchartJsExpr('Highcharts.svg ? ' . 
        HighchartOptionRenderer::render($backgroundOptions) . ' : null')
    )
);
$chart->yAxis = array(
    'labels' => array(
        'distance' => -20
    ),
    'min' => 0,
    'max' => 12,
    'lineWidth' => 0,
    'showFirstLabel' => false,
     
    'minorTickInterval' => 'auto',
    'minorTickWidth' => 1,
    'minorTickLength' => 5,
    'minorTickPosition' => 'inside',
    'minorGridLineWidth' => 0,
    'minorTickColor' => '#666',
    
    'tickInterval' => 1,
    'tickWidth' => 2,
    'tickPosition' => 'inside',
    'tickLength' => 10,
    'tickColor' => '#666',
    
    'title' => array(
        'text' => 'Powered by<br/>Highcharts',
        'style' => array(
            'color' => '#BBB',
            'fontWeight' => 'normal',
            'fontSize' => '8px',
            'lineHeight' => '10px'
        ),
        'y' => 10
    )
);
$chart->tooltip->formatter = new HighchartJsExpr('function () { return this.series.chart.tooltipText; }');
$chart->series[] = array(
    'data' =>array(
        array(
            'id' => 'hour',
            'y' => new HighchartJsExpr('now.hours'),
            'dial' => array(
                'radius' => '60%',
                'baseWidth' => 4,
                'baseLength' => '95%',
                'rearLength' => 0
            )
        ),
        array(
            'id' => 'minute',
            'y' => new HighchartJsExpr('now.minutes'),
            'dial' => array(
                'baseLength' => '95%',
                'rearLength' => 0
            )
        ),
        array(
            'id' => 'second',
            'y' => new HighchartJsExpr('now.seconds'),
            'dial' => array(
                'radius' => '100%',
                'baseWidth' => 1,
                'rearLength' => '20%'
            )
        )
    ),
    'animation' => false,
    'dataLabels' => array(
        'enabled' => false
    )
);
?>

<html>
    <head>
        <title>Clock</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            /**
             * Get the current time
             */
            function getNow () {
                var now = new Date();
                    
                return {
                    hours: now.getHours() + now.getMinutes() / 60,
                    minutes: now.getMinutes() * 12 / 60 + now.getSeconds() * 12 / 3600,
                    seconds: now.getSeconds() * 12 / 60
                };
            };
            
            /**
             * Pad numbers
             */
            function pad(number, length) {
                // Create an array of the remaining length +1 and join it with 0's
                return new Array((length || 2) + 1 - String(number).length).join(0) + number;
            }
            
            var now = getNow();
            $('#container').highcharts(<?php echo $chart->renderOptions();?>,
                // Move
                function (chart) {
                    setInterval(function () {
                        var hour = chart.get('hour'),
                            minute = chart.get('minute'),
                            second = chart.get('second'),
                            now = getNow(),
                            // run animation unless we're wrapping around from 59 to 0
                            animation = now.seconds == 0 ? 
                                false : 
                                {
                                    easing: 'easeOutElastic'
                                };
                                
                        // Cache the tooltip text
                        chart.tooltipText = 
                            pad(Math.floor(now.hours), 2) + ':' + 
                            pad(Math.floor(now.minutes * 5), 2) + ':' + 
                            pad(now.seconds * 5, 2);
                        
                        hour.update(now.hours, true, animation);
                        minute.update(now.minutes, true, animation);
                        second.update(now.seconds, true, animation);
                        
                    }, 1000);
                });
            // Extend jQuery with some easing (copied from jQuery UI)
            $.extend($.easing, {
                easeOutElastic: function (x, t, b, c, d) {
                    var s=1.70158;var p=0;var a=c;
                    if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
                    if (a < Math.abs(c)) { a=c; var s=p/4; }
                    else var s = p/(2*Math.PI) * Math.asin (c/a);
                    return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
                }
            });
        </script>
    </body>
</html>