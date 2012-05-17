<?php
include_once "../../../Highchart.php";

$chart = new Highchart(Highchart::HIGHSTOCK);

$chart->chart->renderTo = "container";
$chart->rangeSelector->selected = 1;
$chart->title->text = "AAPL Stock Price";
$chart->navigator->enabled = false;

$chart->series[] = array('name' => "AAPL Stock Price",
                         'data' => new HighchartJsExpr("data"),
                         'tooltip' => array('valueDecimals' => 2));

?>

<html>
  <head>
    <title>Disabled navigator</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php
      foreach ($chart->getScripts() as $script) {
         echo '<script type="text/javascript" src="' . $script . '"></script>';
      }
    ?>
  </head>
  <body>
    <div id="container"></div>
    <script type="text/javascript">
        $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=?', function(data) {
            <?php echo $chart->render("chart"); ?>;
        });
    </script>
  </body>
</html>