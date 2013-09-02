<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "area";
$chart->title->text = "Area chart with negative values";
$chart->xAxis->categories = array(
    'Apples',
    'Oranges',
    'Pears',
    'Grapes',
    'Bananas'
);
$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
                                    return ''+ this.series.name +': '+ this.y +'';}");
$chart->credits->enabled = false;
$chart->series[] = array(
    'name' => "John",
    'data' => array(
        5,
        3,
        4,
        7,
        2
    )
);
$chart->series[]->name = "Jane";
$chart->series[1]->data = array(
    2,
    - 2,
    - 3,
    2,
    1
);
$chart->series[2]->name = "Joe";
$chart->series[2]->data = array(
    3,
    4,
    4,
    - 2,
    5
);

?>

<html>
    <head>
        <title>Area with negative values</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>