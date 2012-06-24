HighchartsPHP
=============

HighchartsPHP is a PHP library that works has a wrapper for the Highchart js library and it was built having in mind flexibility and maintainability.
HigchartPHP isn't a simple port of the javascript library to PHP. It was designed in a way that mimics the javascript counterpart API, so that the developer only needs to learn one API.

Setup
-----

The config.php file contains the paths to every js file needed by highcharts to work.
The original config file has paths to all files, you can change any one you want to point to your local file system or to point to a different url.

Usage
-----

### Simple

You can create a highchart or highstock chart using one of the three js engine available (jQuery, mootools, and prototype), using the Highchart constructor

$chart = new Highchart(); //This will create a highchart chart with the jquery js engine

$stockChart = new Highchart(Highchart::HIGHSTOCK); //To create a highstock chart with the jquery js engine

$chartWithMootools = new Highchart(null, Highchart::ENGINE_MOOTOOLS); //Create a highchart chart with the mootools js engine

Now that there's a valid $chart object the developer only needs to add elements to the object as if it was writing them in javascript.

$chart->title = array('text' => 'Monthly Average Temperature', 'x' => -20);
OR
$chart->title->text = 'Monthly Average Temperature';
$chart->title->x = -20;

You can also create simple arrays
$chart->series[] = array('name' => 'Tokyo',
                         'data' => array(7.0, 6.9, 9.5));
OR
$chart->series[0] = array('name' => 'Tokyo',
                         'data' => array(7.0, 6.9, 9.5));
OR
$chart->series[0]->name = 'Tokyo';
$chart->series[0]->data = array(7.0, 6.9, 9.5);

### Javascript expressions

If one of the chart options must be a javascript expression, you can't assign a simple string to it, otherwise it will be printed as a simple javascript string also.
For that you must use the special HighchartJsExpr object:
$chart->tooltip->formatter = new HighchartJsExpr("function() { return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+ this.y +'°C';}");

### Render

To get all the script necessary to render your chart you can use the getScripts() method:
foreach ($chart->getScripts() as $script) {
    echo '<script type="text/javascript" src="' . $script . '"></script>';
}

And finally to render the chart object use the render() method
echo $chart->render("chart");

The first (optional) argument passed to render method is the var name to be used by javascript and the second (optional) argument is the callback to be passed to the Highcharts.Chart method.

Demos
-----

All the Highcharts and Highstocks live demos present on http://www.highcharts.com under the demo gallery were reproduced using this library and you can find them on the demos folder.