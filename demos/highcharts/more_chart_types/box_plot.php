<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();
$chart->includeExtraScripts();

$chart->chart = array(
    'renderTo' => 'container',
    'type' => 'boxplot'
);
$chart->title->text = 'Highcharts Box Plot Example';
$chart->legend->enabled = false;
$chart->xAxis = array(
    'categories' => array('1', '2', '3', '4', '5'),
    'title' => array(
        'text' => 'Experiment No.'
    )
);
$chart->yAxis = array(
    'title' => array(
        'text' => 'Observations'
    ),
    'plotLines' => array(
        array(
            'value' => 932,
            'color' => 'red',
            'width' => 1,
            'label' => array(
                'text' => 'Theoretical mean: 932',
                'align' => 'center',
                'style' => array(
                    'color' => 'gray'
                )
            )
        )
    )
);
$chart->series[] = array(
    'name' => 'Observations',
    'data' => array(
        array(760, 801, 848, 895, 965),
        array(733, 853, 939, 980, 1080),
        array(714, 762, 817, 870, 918),
        array(724, 802, 806, 871, 950),
        array(834, 836, 864, 882, 910),
    ),
    'tooltip' => array(
        'headerFormat' => '<em>Experiment No {point.key}</em><br/>'
    )
);
$chart->series[] = array(
    'name' => 'Outlier',
    'color' => new HighchartJsExpr('Highcharts.getOptions().colors[0]'),
    'type' => 'scatter',
    'data' => array(
        array(0, 644),
        array(4, 718),
        array(4, 718),
        array(4, 969)
    ),
    'marker' => array(
        'fillColor' => 'white',
        'lineWidth' => 1,
        'lineColor' => new HighchartJsExpr('Highcharts.getOptions().colors[0]')
    ),
    'tooltip' => array(
        'pointFormat' => 'Observation: {point.y}'
    )
);
?>

<html>
    <head>
        <title>Box plot</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>