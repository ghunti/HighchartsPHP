<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "spline";
$chart->title->text = "Wind speed during two days";
$chart->subtitle->text = "October 6th and 7th 2009 at two locations in Vik i Sogn, Norway";
$chart->xAxis->type = "datetime";
$chart->yAxis->title->text = "Wind speed (m/s)";
$chart->yAxis->min = 0;
$chart->yAxis->minorGridLineWidth = 0;
$chart->yAxis->gridLineWidth = 0;
$chart->yAxis->alternateGridColor = false;
$chart->yAxis->plotBands[] = array(
    'from' => 0.3,
    'to' => 1.5,
    'color' => "rgba(68, 170, 213, 0.1)",
    'label' => array(
        'text' => "Light air",
        'style' => array(
            'color' => "#606060"
        )
    )
);

$chart->yAxis->plotBands[1]->from = 1.5;
$chart->yAxis->plotBands[1]->to = 3.3;
$chart->yAxis->plotBands[1]->color = "rgba(0, 0, 0, 0)";
$chart->yAxis->plotBands[1]->label->text = "Light breeze";
$chart->yAxis->plotBands[1]->label->style->color = "#606060";

$chart->yAxis->plotBands[]->from = 3.3;
$chart->yAxis->plotBands[2]->to = 5.5;
$chart->yAxis->plotBands[2]->color = "rgba(68, 170, 213, 0.1)";
$chart->yAxis->plotBands[2]->label->text = "Gentle breeze";
$chart->yAxis->plotBands[2]->label->style->color = "#606060";

$chart->yAxis->plotBands[] = array(
    'from' => 5.5,
    'to' => 8,
    'color' => "rgba(0, 0, 0, 0)",
    'label' => array(
        'text' => "Moderate breeze",
        'style' => array(
            'color' => "#606060"
        )
    )
);

$chart->yAxis->plotBands[] = array(
    'from' => 8,
    'to' => 11,
    'color' => "rgba(68, 170, 213, 0.1)",
    'label' => array(
        'text' => "Fresh breeze",
        'style' => array(
            'color' => "#606060"
        )
    )
);

$chart->yAxis->plotBands[] = array(
    'from' => 11,
    'to' => 14,
    'color' => "rgba(0, 0, 0, 0)",
    'label' => array(
        'text' => "Strong breeze",
        'style' => array(
            'color' => "#606060"
        )
    )
);

$chart->yAxis->plotBands[] = array(
    'from' => 14,
    'to' => 15,
    'color' => "rgba(68, 170, 213, 0.1)",
    'label' => array(
        'text' => "High wind",
        'style' => array(
            'color' => "#606060"
        )
    )
);

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
                                return ''+
                                Highcharts.dateFormat('%e. %b %Y, %H:00', this.x) +': '+ this.y +' m/s';}");
$chart->plotOptions->spline->lineWidth = 4;
$chart->plotOptions->spline->states->hover->lineWidth = 5;
$chart->plotOptions->spline->marker->enabled = false;
$chart->plotOptions->spline->marker->states->hover->enabled = 1;
$chart->plotOptions->spline->marker->states->hover->symbol = "circle";
$chart->plotOptions->spline->marker->states->hover->radius = 5;
$chart->plotOptions->spline->marker->states->hover->lineWidth = 1;
$chart->plotOptions->spline->pointInterval = 3600000;
$chart->plotOptions->spline->pointStart = new HighchartJsExpr("Date.UTC(2009, 9, 6, 0, 0, 0)");
$chart->series[] = array(
    'name' => "Hestavollane",
    'data' => array(
        4.3,
        5.1,
        4.3,
        5.2,
        5.4,
        4.7,
        3.5,
        4.1,
        5.6,
        7.4,
        6.9,
        7.1,
        7.9,
        7.9,
        7.5,
        6.7,
        7.7,
        7.7,
        7.4,
        7.0,
        7.1,
        5.8,
        5.9,
        7.4,
        8.2,
        8.5,
        9.4,
        8.1,
        10.9,
        10.4,
        10.9,
        12.4,
        12.1,
        9.5,
        7.5,
        7.1,
        7.5,
        8.1,
        6.8,
        3.4,
        2.1,
        1.9,
        2.8,
        2.9,
        1.3,
        4.4,
        4.2,
        3.0,
        3.0
    )
);

$chart->series[] = array(
    'name' => "Voll",
    'data' => array(
        0.0,
        0.0,
        0.0,
        0.0,
        0.0,
        0.0,
        0.0,
        0.0,
        0.1,
        0.0,
        0.3,
        0.0,
        0.0,
        0.4,
        0.0,
        0.1,
        0.0,
        0.0,
        0.0,
        0.0,
        0.0,
        0.0,
        0.0,
        0.0,
        0.0,
        0.6,
        1.2,
        1.7,
        0.7,
        2.9,
        4.1,
        2.6,
        3.7,
        3.9,
        1.7,
        2.3,
        3.0,
        3.3,
        4.8,
        5.0,
        4.8,
        5.0,
        3.2,
        2.0,
        0.9,
        0.4,
        0.3,
        0.5,
        0.4
    )
);

$chart->navigation->menuItemStyle->fontSize = "10px";
?>

<html>
    <head>
        <title>Spline with plot bands</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>