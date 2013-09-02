<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
     DIRECTORY_SEPARATOR . 'Highchart.php';

$chart = new Highchart();

$chart->chart->renderTo = 'container';
$chart->title->text = 'Daily visits at www.highcharts.com';
$chart->subtitle->text = 'Source: Google Analytics';

$chart->xAxis->type = 'datetime';
$chart->xAxis->tickInterval = 7 * 24 * 3600 * 1000;
$chart->xAxis->tickWidth = 0;
$chart->xAxis->gridLineWidth = 1;
$chart->xAxis->labels->align = 'left';
$chart->xAxis->labels->x = 3;
$chart->xAxis->labels->y = - 3;

$leftYaxis = new HighchartOption();
$leftYaxis->title->text = null;
$leftYaxis->labels->align = 'left';
$leftYaxis->labels->x = 3;
$leftYaxis->labels->y = 16;
$leftYaxis->labels->formatter = new HighchartJsExpr("function() { return Highcharts.numberFormat(this.value, 0);}");
$leftYaxis->showFirstLabel = false;
$chart->yAxis[] = $leftYaxis;

$rightYaxis = new HighchartOption();
$rightYaxis->linkedTo = 0;
$rightYaxis->gridLineWidth = 0;
$rightYaxis->opposite = true;
$rightYaxis->title->text = null;
$rightYaxis->labels->align = 'right';
$rightYaxis->labels->x = - 3;
$rightYaxis->labels->y = 16;
$rightYaxis->labels->formatter = new HighchartJsExpr("function() { return Highcharts.numberFormat(this.value, 0);}");
$rightYaxis->showFirstLabel = false;
$chart->yAxis[] = $rightYaxis;

// The yAxis can also be an array of non-associative arrays

/*
 * $chart->yAxis = array(array('title' => array('text' => null), 'labels' =>
 * array('align' => 'left', 'x' => 3, 'y' => 16, 'formatter' => new
 * HighchartJsExpr("function() { return Highcharts.numberFormat(this.value,
 * 0);}")), 'showFirstLabel' => false), array('linkedTo' => 0, 'gridLineWidth'
 * => 0, 'opposite' => true, 'title' => array('text' => null), 'labels' =>
 * array('align' => 'right', 'x' => -3, 'y' => 16, 'formatter' => new
 * HighchartJsExpr("function() { return Highcharts.numberFormat(this.value,
 * 0);}")) ));
 */

$chart->legend = array(
    'align' => 'left',
    'verticalAlign' => 'top',
    'y' => 20,
    'floating' => true,
    'borderWidth' => 0
);

$chart->tooltip = array(
    'shared' => true,
    'crosshairs' => true
);

$clickFunction = new HighchartJsExpr(
    "function() {
        hs.htmlExpand(null, {
            pageOrigin: {
                x: this.pageX,
                y: this.pageY
            },
            headingText: this.series.name,
            maincontentText: Highcharts.dateFormat('%A, %b %e, %Y', this.x) +':<br/> '+
                this.y +' visits',
            width: 200
        });
    }"
);
$chart->plotOptions->series->cursor = 'pointer';
$chart->plotOptions->series->point->events->click = $clickFunction;
$chart->plotOptions->series->marker->lineWidth = 1;

$chart->series[] = array(
    'name' => 'All visits',
    'lineWidth' => 4,
    'marker' => array(
        'radius' => 4
    )
);
$chart->series[]->name = 'New visitors';

?>
<html>
    <head>
    <title>Ajax loaded data clickable points</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
        <script type="text/javascript" src="http://www.highcharts.com/highslide/highslide-full.min.js"></script>
        <script type="text/javascript" src="http://www.highcharts.com/highslide/highslide.config.js" charset="utf-8"></script>
        <link rel="stylesheet" type="text/css" href="http://www.highcharts.com/highslide/highslide.css" />
        <!--[if lt IE 7]>
        <link rel="stylesheet" type="text/css" href="http://www.highcharts.com/highslide/highslide-ie6.css" />
        <![endif]-->
        <!-- End Highslide code -->
    </head>
    <body>

        <script type="text/javascript">

        (function($){ // encapsulate jQuery

        var chart;
        $(document).ready(function() {

            var options = <?php echo $chart->renderOptions(); ?>

            // Load data asynchronously using jQuery. On success, add the data
            // to the options and initiate the chart.
            // This data is obtained by exporting a GA custom report to TSV.
            // http://api.jquery.com/jQuery.get/
            jQuery.get('analytics.tsv', null, function(tsv, state, xhr) {
                var lines = [],
                    listen = false,
                    date,

                    // set up the two data series
                    allVisits = [],
                    newVisitors = [];

                // inconsistency
                if (typeof tsv !== 'string') {
                    tsv = xhr.responseText;
                }

                // split the data return into lines and parse them
                tsv = tsv.split(/\n/g);
                jQuery.each(tsv, function(i, line) {

                    // listen for data lines between the Graph and Table headers
                    if (tsv[i - 3] == '# Graph') {
                        listen = true;
                    } else if (line == '' || line.charAt(0) == '#') {
                        listen = false;
                    }

                    // all data lines start with a double quote
                    if (listen) {
                        line = line.split(/\t/);
                        date = Date.parse(line[0] +' UTC');

                        allVisits.push([
                            date,
                            parseInt(line[1].replace(',', ''), 10)
                        ]);
                        newVisitors.push([
                            date,
                            parseInt(line[2].replace(',', ''), 10)
                        ]);
                    }
                });

                options.series[0].data = allVisits;
                options.series[1].data = newVisitors;

                chart = new Highcharts.Chart(options);
            });
        });

        })(jQuery);
        </script>

        <div id="container"></div>

    </body>
</html>
