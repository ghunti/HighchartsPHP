<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->zoomType = "xy";
$chart->title->text = "Average Monthly Weather Data for Tokyo";
$chart->subtitle->text = "Source: WorldClimate.com";

$chart->xAxis = array(
    array(
        'categories' => array(
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
        )
    )
);

$primaryYaxis = new HighchartOption();

$primaryYaxis->labels->formatter = new HighchartJsExpr("function() {
    return this.value +'°C'; }");

$primaryYaxis->labels->style->color = "#89A54E";
$primaryYaxis->title->text = "Temperature";
$primaryYaxis->title->style->color = "#89A54E";
$primaryYaxis->opposite = true;

$secondaryYaxis = new HighchartOption();
$secondaryYaxis->gridLineWidth = 0;
$secondaryYaxis->title->text = "Rainfall";
$secondaryYaxis->title->style->color = "#4572A7";

$secondaryYaxis->labels->formatter = new HighchartJsExpr("function() {
    return this.value +' mm'; }");

$secondaryYaxis->labels->style->color = "#4572A7";

$tertiaryYaxis = new HighchartOption();
$tertiaryYaxis->gridLineWidth = 0;
$tertiaryYaxis->title->text = "Sea-Level Pressure";
$tertiaryYaxis->title->style->color = "#AA4643";

$tertiaryYaxis->labels->formatter = new HighchartJsExpr("function() {
    return this.value +' mb'; }");

$tertiaryYaxis->labels->style->color = "#AA4643";
$tertiaryYaxis->opposite = true;
$chart->yAxis = array(
    $primaryYaxis,
    $secondaryYaxis,
    $tertiaryYaxis
);

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    var unit = {
      'Rainfall': 'mm',
      'Temperature': '°C',
      'Sea-Level Pressure': 'mb'
    }[this.series.name];

    return '' + this.x +': '+ this.y +' '+ unit; }");

$chart->legend->layout = "vertical";
$chart->legend->align = "left";
$chart->legend->x = 120;
$chart->legend->verticalAlign = "top";
$chart->legend->y = 80;
$chart->legend->floating = 1;
$chart->legend->backgroundColor = "#FFFFFF";

$chart->series[] = array(
    'name' => "Rainfall",
    'color' => "#4572A7",
    'type' => "column",
    'yAxis' => 1,
    'data' => array(
        49.9,
        71.5,
        106.4,
        129.2,
        144.0,
        176.0,
        135.6,
        148.5,
        216.4,
        194.1,
        95.6,
        54.4
    )
);

$chart->series[] = array(
    'name' => "Sea-Level Pressure",
    'color' => "#AA4643",
    'type' => "spline",
    'yAxis' => 2,
    'data' => array(
        1016,
        1016,
        1015.9,
        1015.5,
        1012.3,
        1009.5,
        1009.6,
        1010.2,
        1013.1,
        1016.9,
        1018.2,
        1016.7
    ),
    'marker' => array(
        'enabled' => false
    ),
    'dashStyle' => "shortdot"
);

$chart->series[] = array(
    'name' => "Temperature",
    'color' => "#89A54E",
    'type' => "spline",
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
?>

<html>
    <head>
    <title>Multiple axes</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
    </body>
</html>