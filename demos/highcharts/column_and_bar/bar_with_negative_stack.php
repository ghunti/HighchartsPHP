<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "bar";
$chart->title->text = "Population pyramid for Germany, midyear 2010";
$chart->subtitle->text = "Source: www.census.gov";

// xAxis can be an array of non-associative arrays.
// It can also be an array of objects (associative arrays), for
// an example with both scenarios see
// demos/highcharts/ajax_loaded_data_clickable_points.php
$chart->xAxis = array(
    array(
        'categories' => new HighchartJsExpr("categories"),
        'reversed' => false
    ),
    array(
        'opposite' => true,
        'reversed' => false,
        'categories' => new HighchartJsExpr("categories"),
        'linkedTo' => 0
    )
);

$chart->yAxis->title->text = null;

$chart->yAxis->labels->formatter = new HighchartJsExpr("function(){
    return (Math.abs(this.value) / 1000000) + 'M';}");

$chart->yAxis->min = - 4000000;
$chart->yAxis->max = 4000000;
$chart->plotOptions->series->stacking = "normal";

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.series.name +', age '+ this.point.category +'</b><br/>'+
    'Population: '+ Highcharts.numberFormat(Math.abs(this.point.y), 0);}");

$chart->series[] = array(
    'name' => "Female",
    'data' => array(
        - 1746181,
        - 1884428,
        - 2089758,
        - 2222362,
        - 2537431,
        - 2507081,
        - 2443179,
        - 2664537,
        - 3556505,
        - 3680231,
        - 3143062,
        - 2721122,
        - 2229181,
        - 2227768,
        - 2176300,
        - 1329968,
        - 836804,
        - 354784,
        - 90569,
        - 28367,
        - 3878
    )
);

$chart->series[] = array(
    'name' => "Male",
    'data' => array(
        1656154,
        1787564,
        1981671,
        2108575,
        2403438,
        2366003,
        2301402,
        2519874,
        3360596,
        3493473,
        3050775,
        2759560,
        2304444,
        2426504,
        2568938,
        1785638,
        1447162,
        1005011,
        330870,
        130632,
        21208
    )
);
?>

<html>
    <head>
        <title>Bar with negative stack</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            var categories = ['0-4', '5-9', '10-14', '15-19',
            '20-24', '25-29', '30-34', '35-39', '40-44',
            '45-49', '50-54', '55-59', '60-64', '65-69',
            '70-74', '75-79', '80-84', '85-89', '90-94',
            '95-99', '100 +'];
            <?php echo $chart->render("chart1"); ?>
        </script>
    </body>
</html>