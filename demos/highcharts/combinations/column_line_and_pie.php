<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->title->text = "Combination chart";
$chart->xAxis->categories = array(
    'Apples',
    'Oranges',
    'Pears',
    'Bananas',
    'Plums'
);

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    var s;
    if (this.point.name) { // the pie chart
        s = ''+
        this.point.name +': '+ this.y +' fruits';
    } else {
        s = ''+
        this.x  +': '+ this.y;
    }
    return s; }");

$chart->labels->items = array(
    array(
        'html' => "Total fruit consumption",
        'style' => array(
            'left' => "40px",
            'top' => "8px",
            'color' => "black"
        )
    )
);

$chart->series[] = array(
    'type' => "column",
    'name' => "Jane",
    'data' => array(
        3,
        2,
        1,
        3,
        4
    )
);

$chart->series[] = array(
    'type' => "column",
    'name' => "John",
    'data' => array(
        2,
        3,
        5,
        7,
        6
    )
);

$chart->series[] = array(
    'type' => "column",
    'name' => "Joe",
    'data' => array(
        4,
        3,
        3,
        9,
        0
    )
);

$chart->series[] = array(
    'type' => "spline",
    'name' => "Average",
    'data' => array(
        3,
        2.67,
        3,
        6.33,
        3.33
    )
);

$chart->series[] = array(
    'type' => "pie",
    'name' => "Total consumption",
    'data' => array(
        array(
            'name' => "Jane",
            'y' => 13,
            'color' => "#4572A7"
        ),
        array(
            'name' => "John",
            'y' => 23,
            'color' => "#AA4643"
        ),
        array(
            'name' => "Joe",
            'y' => 19,
            'color' => "#89A54E"
        )
    ),
    'center' => array(
        100,
        80
    ),
    'size' => 100,
    'showInLegend' => false,
    'dataLabels' => array(
        'enabled' => false
    )
);
?>

<html>
    <head>
    <title>Column line and pie</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>