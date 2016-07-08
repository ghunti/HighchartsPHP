<?php
use Ghunti\HighchartsPHP\Highchart;
use Ghunti\HighchartsPHP\HighchartJsExpr;

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart = array(
    'renderTo' => 'container',
    'type' => 'heatmap',
    'marginTop' => 40,
    'marginBottom' => 80,
    'plotBorderWidth' => 1
);
$chart->title->text = 'Highcharts Heat Map';
$chart->xAxis->categories = array('Alexander', 'Marie', 'Maximilian', 'Sophia', 'Lukas', 'Maria', 'Leon', 'Anna', 'Tim', 'Laura');
$chart->yAxis = array(
    'categories' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'),
    'title' => null
);
$chart->colorAxis = array(
    'min' => 0,
    'minColor' => '#FFFFFF',
    'maxColor' => new HighchartJsExpr('Highcharts.getOptions().colors[0]')
);
$chart->legend = array(
    'align' => 'right',
    'layout' => 'vertical',
    'margin' => 0,
    'verticalAlign' => 'top',
    'y' => 25,
    'symbolHeight' => 280
);
$chart->tooltip = array(
    'formatter' => new HighchartJsExpr('function () {
        return \'<b>\' + this.series.xAxis.categories[this.point.x] + \'</b> sold <br><b>\' +
            this.point.value + \'</b> items on <br><b>\' + this.series.yAxis.categories[this.point.y] + \'</b>\';
    }')
);
$chart->series = array(
    array(
        'name' => 'Sales per employee',
        'borderWidth' => 1,
        'data' => array(
            array(0, 0, 10), array(0, 1, 19),  array(0, 2, 8),   array(0, 3, 24),  array(0, 4, 67), 
            array(1, 0, 92), array(1, 1, 58),  array(1, 2, 78),  array(1, 3, 117), array(1, 4, 48), 
            array(2, 0, 35), array(2, 1, 15),  array(2, 2, 123), array(2, 3, 64),  array(2, 4, 52), 
            array(3, 0, 72), array(3, 1, 132), array(3, 2, 114), array(3, 3, 19),  array(3, 4, 16), 
            array(4, 0, 38), array(4, 1, 5),   array(4, 2, 8),   array(4, 3, 117), array(4, 4, 115), 
            array(5, 0, 88), array(5, 1, 32),  array(5, 2, 12),  array(5, 3, 6),   array(5, 4, 120), 
            array(6, 0, 13), array(6, 1, 44),  array(6, 2, 88),  array(6, 3, 98),  array(6, 4, 96), 
            array(7, 0, 31), array(7, 1, 1),   array(7, 2, 82),  array(7, 3, 32),  array(7, 4, 30), 
            array(8, 0, 85), array(8, 1, 97),  array(8, 2, 123), array(8, 3, 64),  array(8, 4, 84), 
            array(9, 0, 47), array(9, 1, 114), array(9, 2, 31),  array(9, 3, 48),  array(9, 4, 91)
        ),
        'dataLabels' => array(
            'enabled' => true,
            'color' => '#000000'
        )
    )
);
?>

<html>
    <head>
        <title>Heat Map</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
        <script src="http://code.highcharts.com/modules/heatmap.js"></script>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>