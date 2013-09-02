<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "column";
$chart->title->text = "Browser market share, April, 2011";
$chart->subtitle->text = "Click the columns to view versions. Click again to view brands.";
$chart->xAxis->categories = new HighchartJsExpr("categories");
$chart->yAxis->title->text = "Total percent market share";
$chart->plotOptions->column->cursor = "pointer";

$chart->plotOptions->column->point->events->click = new HighchartJsExpr(
    "function() {
    var drilldown = this.drilldown;
    if (drilldown) { // drill down
      setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
    } else { // restore
      setChart(name, categories, data);
    }}");

$chart->plotOptions->column->dataLabels->enabled = 1;
$chart->plotOptions->column->dataLabels->color = new HighchartJsExpr("colors[0]");
$chart->plotOptions->column->dataLabels->style->fontWeight = "bold";

$chart->plotOptions->column->dataLabels->formatter = new HighchartJsExpr("function() {
    return this.y +'%';}");

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    var point = this.point,
        s = this.x +':<b>'+ this.y +'% market share</b><br/>';
    if (point.drilldown) {
      s += 'Click to view '+ point.category +' versions';
    } else {
      s += 'Click to return to browser brands';
    }
    return s;}");

$chart->series[] = array(
    'name' => new HighchartJsExpr("name"),
    'data' => new HighchartJsExpr("data"),
    'color' => 'white'
);

$chart->exporting->enabled = false;

?>

<html>
    <head>
        <title>Column with drilldown</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
          var colors = Highcharts.getOptions().colors,
          categories = ['MSIE', 'Firefox', 'Chrome', 'Safari', 'Opera'],
          name = 'Browser brands',
          data = [{
              y: 55.11,
              color: colors[0],
              drilldown: {
                name: 'MSIE versions',
                categories: ['MSIE 6.0', 'MSIE 7.0', 'MSIE 8.0', 'MSIE 9.0'],
                data: [10.85, 7.35, 33.06, 2.81],
                color: colors[0]
              }
            }, {
              y: 21.63,
              color: colors[1],
              drilldown: {
                name: 'Firefox versions',
                categories: ['Firefox 2.0', 'Firefox 3.0', 'Firefox 3.5', 'Firefox 3.6', 'Firefox 4.0'],
                data: [0.20, 0.83, 1.58, 13.12, 5.43],
                color: colors[1]
              }
            }, {
              y: 11.94,
              color: colors[2],
              drilldown: {
                name: 'Chrome versions',
                categories: ['Chrome 5.0', 'Chrome 6.0', 'Chrome 7.0', 'Chrome 8.0', 'Chrome 9.0',
                  'Chrome 10.0', 'Chrome 11.0', 'Chrome 12.0'],
                data: [0.12, 0.19, 0.12, 0.36, 0.32, 9.91, 0.50, 0.22],
                color: colors[2]
              }
            }, {
              y: 7.15,
              color: colors[3],
              drilldown: {
                name: 'Safari versions',
                categories: ['Safari 5.0', 'Safari 4.0', 'Safari Win 5.0', 'Safari 4.1', 'Safari/Maxthon',
                  'Safari 3.1', 'Safari 4.1'],
                data: [4.55, 1.42, 0.23, 0.21, 0.20, 0.19, 0.14],
                color: colors[3]
              }
            }, {
              y: 2.14,
              color: colors[4],
              drilldown: {
                name: 'Opera versions',
                categories: ['Opera 9.x', 'Opera 10.x', 'Opera 11.x'],
                data: [ 0.12, 0.37, 1.65],
                color: colors[4]
              }
            }];

          function setChart(name, categories, data, color) {
            chart.xAxis[0].setCategories(categories);
            chart.series[0].remove();
            chart.addSeries({
              name: name,
              data: data,
              color: color || 'white'
            });
          }
        <?php echo $chart->render("chart"); ?>
        </script>
    </body>
</html>