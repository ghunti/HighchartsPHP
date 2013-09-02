<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "pie";
$chart->title->text = "Browser market share, April, 2011";
$chart->yAxis->title->text = "Total percent market share";
$chart->plotOptions->pie->shadow = false;

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.point.name +'</b>: '+ this.y +' %'; }");

$chart->series[] = array(
    'name' => "Browsers",
    'data' => new HighchartJsExpr("browserData"),
    'size' => "60%",
    'dataLabels' => array(
        'formatter' => new HighchartJsExpr("function() {
    return this.y > 5 ? this.point.name : null; }"),
        'color' => 'white',
        'distance' => - 30
    )
);

$chart->series[1]->name = "Versions";
$chart->series[1]->data = new HighchartJsExpr("versionsData");
$chart->series[1]->innerSize = "60%";

$chart->series[1]->dataLabels->formatter = new HighchartJsExpr(
    "function() {
    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ this.y +'%'  : null;}");

// We can also use Highchart library to produce any kind of javascript
// structures
$chartData = new Highchart();
$chartData[0]->y = 55.11;
$chartData[0]->color = new HighchartJsExpr("colors[0]");
$chartData[0]->drilldown->name = "MSIE versions";
$chartData[0]->drilldown->categories = array(
    'MSIE 6.0',
    'MSIE 7.0',
    'MSIE 8.0',
    'MSIE 9.0'
);
$chartData[0]->drilldown->data = array(
    10.85,
    7.35,
    33.06,
    2.81
);
$chartData[0]->drilldown->color = new HighchartJsExpr("colors[0]");

$chartData[1]->y = 21.63;
$chartData[1]->color = new HighchartJsExpr("colors[1]");
$chartData[1]->drilldown->name = "Firefox versions";

$chartData[1]->drilldown->categories = array(
    'Firefox 2.0',
    'Firefox 3.0',
    'Firefox 3.5',
    'Firefox 3.6',
    'Firefox 4.0'
);

$chartData[1]->drilldown->data = array(
    0.20,
    0.83,
    1.58,
    13.12,
    5.43
);
$chartData[1]->drilldown->color = new HighchartJsExpr("colors[1]");

$chartData[2]->y = 11.94;
$chartData[2]->color = new HighchartJsExpr("colors[2]");
$chartData[2]->drilldown->name = "Chrome versions";

$chartData[2]->drilldown->categories = array(
    'Chrome 5.0',
    'Chrome 6.0',
    'Chrome 7.0',
    'Chrome 8.0',
    'Chrome 9.0',
    'Chrome 10.0',
    'Chrome 11.0',
    'Chrome 12.0'
);

$chartData[2]->drilldown->data = array(
    0.12,
    0.19,
    0.12,
    0.36,
    0.32,
    9.91,
    0.50,
    0.22
);
$chartData[2]->drilldown->color = new HighchartJsExpr("colors[2]");

$chartData[3]->y = 7.15;
$chartData[3]->color = new HighchartJsExpr("colors[3]");
$chartData[3]->drilldown->name = "Safari versions";

$chartData[3]->drilldown->categories = array(
    'Safari 5.0',
    'Safari 4.0',
    'Safari Win 5.0',
    'Safari 4.1',
    'Safari/Maxthon',
    'Safari 3.1',
    'Safari 4.1'
);

$chartData[3]->drilldown->data = array(
    4.55,
    1.42,
    0.23,
    0.21,
    0.20,
    0.19,
    0.14
);
$chartData[3]->drilldown->color = new HighchartJsExpr("colors[3]");

$chartData[4]->y = 2.14;
$chartData[4]->color = new HighchartJsExpr("colors[4]");
$chartData[4]->drilldown->name = "Opera versions";
$chartData[4]->drilldown->categories = array(
    'Opera 9.x',
    'Opera 10.x',
    'Opera 11.x'
);
$chartData[4]->drilldown->data = array(
    0.12,
    0.37,
    1.65
);
$chartData[4]->drilldown->color = new HighchartJsExpr("colors[4]");
?>

<html>
    <head>
        <title>Donut chart</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            var colors = Highcharts.getOptions().colors,
                categories = ['MSIE', 'Firefox', 'Chrome', 'Safari', 'Opera'],
                name = 'Browser brands',
                data = <?php echo $chartData->renderOptions(); ?>;


              // Build the data arrays
              var browserData = [];
              var versionsData = [];
              for (var i = 0; i < data.length; i++) {

                // add browser data
                browserData.push({
                  name: categories[i],
                  y: data[i].y,
                  color: data[i].color
                });

                // add version data
                for (var j = 0; j < data[i].drilldown.data.length; j++) {
                  var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
                  versionsData.push({
                    name: data[i].drilldown.categories[j],
                    y: data[i].drilldown.data[j],
                    color: Highcharts.Color(data[i].color).brighten(brightness).get()
                  });
                }
              }
            <?php echo $chart->render("chart1"); ?>
        </script>
    </body>
</html>