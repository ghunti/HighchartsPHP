<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "column";
$chart->title->text = "Data extracted from a HTML table in the page";
$chart->xAxis = new HighchartOption(); // We need it to be empty to avoid js
                                       // errors
$chart->yAxis->title->text = "Units";

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.series.name +'</b><br/>'+
    this.y +' '+ this.x.toLowerCase();}");
?>

<html>
    <head>
        <title>Data defined in a HTML table</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            $(document).ready(function() {
                Highcharts.visualize = function(table, options) {
                    // the categories
                    options.xAxis.categories = [];
                    $('tbody th', table).each( function(i) {
                        options.xAxis.categories.push(this.innerHTML);
                    });

                    // the data series
                    options.series = [];
                    $('tr', table).each( function(i) {
                        var tr = this;
                        $('th, td', tr).each( function(j) {
                            if (j > 0) { // skip first column
                                if (i == 0) { // get the name and init the series
                                    options.series[j - 1] = {
                                        name: this.innerHTML,
                                        data: []
                                    };
                                } else { // add values
                                  options.series[j - 1].data.push(parseFloat(this.innerHTML));
                              }
                          }
                        });
                    });

                    var chart = new Highcharts.Chart(options);
                }

                var table = document.getElementById('datatable'),
                options = <?php echo $chart->renderOptions(); ?>;
                Highcharts.visualize(table, options);
            });
        </script>
        <table id="datatable">
            <thead>
                <tr>
                    <th></th>
                    <th>Jane</th>
                    <th>John</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Apples</th>
                    <td>3</td>
                    <td>4</td>
                </tr>
                <tr>
                    <th>Pears</th>
                    <td>2</td>
                    <td>0</td>
                </tr>
                <tr>
                    <th>Plums</th>
                    <td>5</td>
                    <td>11</td>
                </tr>
                <tr>
                    <th>Bananas</th>
                    <td>1</td>
                    <td>1</td>
                </tr>
                <tr>
                    <th>Oranges</th>
                    <td>2</td>
                    <td>4</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>