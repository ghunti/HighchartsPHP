<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart->renderTo = 'container';
$chart->chart->polar = true;
$chart->chart->type = 'line';
$chart->title->text = 'Budget vs spending';
$chart->title->x = -80;
$chart->pane->size = '80%';
$chart->pane->endAngle = 360;
$chart->xAxis->categories = array(
    'Sales',
    'Marketing',
    'Development',
    'Customer Support',
    'Information Technology',
    'Administration'
);
$chart->xAxis->tickmarkPlacement = 'on';
$chart->xAxis->lineWidth = 0;
$chart->yAxis->gridLineInterpolation = 'polygon';
$chart->yAxis->lineWidth = 0;
$chart->yAxis->min = 0;
$chart->tooltip->shared = true;
$chart->tooltip->pointFormat = '<span style="color:{series.color}">{series.name}: <b>${point.y:,.0f}</b><br/>';
$chart->legend->align = 'right';
$chart->legend->verticalAlign = 'top';
$chart->legend->y = 70;
$chart->legend->layout = 'vertical';
$chart->series = array(
    array(
        'name' => 'Allocated Budget',
        'data' => array(43000, 19000, 60000, 35000, 17000, 10000),
        'pointPlacement' => 'on'
    ),
    array(
        'name' => 'Actual Spending',
        'data' => array(50000, 39000, 42000, 31000, 26000, 14000),
        'pointPlacement' => 'on'
    )
);
?>

<html>
    <head>
        <title>Spiderweb</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>