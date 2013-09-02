<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart = array(
    'renderTo' => 'container',
    'type' => 'line',
    'marginRight' => 130,
    'marginBottom' => 25
);

$chart->title = array(
    'text' => 'Monthly Average Temperature',
    'x' => - 20
);
$chart->subtitle = array(
    'text' => 'Source: WorldClimate.com',
    'x' => - 20
);

$chart->xAxis->categories = array(
    'Jan',
    'Feb',
    'Mar',
    'Apr',
    'May',
    'Jun',
    'Jul',
    'Aug',
    'Sep',
    'Oct',
    'Nov',
    'Dec'
);

$chart->yAxis = array(
    'title' => array(
        'text' => 'Temperature (°C)'
    ),
    'plotLines' => array(
        array(
            'value' => 0,
            'width' => 1,
            'color' => '#808080'
        )
    )
);
$chart->legend = array(
    'layout' => 'vertical',
    'align' => 'right',
    'verticalAlign' => 'top',
    'x' => - 10,
    'y' => 100,
    'borderWidth' => 0
);

$chart->series[] = array(
    'name' => 'Tokyo',
    'data' => array(
        7.0,
        6.9,
        9.5,
        14.5,
        18.2,
        21.5,
        25.2,
        26.5,
        23.3,
        18.3,
        13.9,
        9.6
    )
);
$chart->series[] = array(
    'name' => 'New York',
    'data' => array(
        - 0.2,
        0.8,
        5.7,
        11.3,
        17.0,
        22.0,
        24.8,
        24.1,
        20.1,
        14.1,
        8.6,
        2.5
    )
);
$chart->series[] = array(
    'name' => 'Berlin',
    'data' => array(
        - 0.9,
        0.6,
        3.5,
        8.4,
        13.5,
        17.0,
        18.6,
        17.9,
        14.3,
        9.0,
        3.9,
        1.0
    )
);
$chart->series[] = array(
    'name' => 'London',
    'data' => array(
        3.9,
        4.2,
        5.7,
        8.5,
        11.9,
        15.2,
        17.0,
        16.6,
        14.2,
        10.3,
        6.6,
        4.8
    )
);

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() { return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+ this.y +'°C';}");
?>

<html>
    <head>
        <title>Basic Line</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>