HighchartsPHP
=============

HighchartsPHP is a PHP library that works has a wrapper for the **Highchart js** library (http://www.highcharts.com) and it was built having in mind flexibility and maintainability.
It isn't a simple port of the JavaScript library to PHP, it was designed in a way that mimics the JavaScript counterpart API, so that the developer only needs to learn one API.

The companion webpage can be found at http://www.goncaloqueiros.net/highcharts.php

Setup
-----

* Copy config.dist.php to config.php

The `config.php` file contains the paths to every js file needed by highcharts to work. Change any path you want to point to your local file system or to point to a different url. 

Usage
-----

### Simple

You can create a highchart or highstock chart using one of the three js engine available (jQuery, mootools, and prototype), using the Highchart constructor.

```php
//This will create a highchart chart with the jquery js engine
$chart = new Highchart();
```

```php
//To create a highstock chart with the jquery js engine
$stockChart = new Highchart(Highchart::HIGHSTOCK);
```

```php
//Create a highchart chart with the mootools js engine
$chartWithMootools = new Highchart(null, Highchart::ENGINE_MOOTOOLS);;
```

Now that there's a valid `$chart` object the developer only needs to add elements to it as if it was writing them in JavaScript.

```php
$chart->title = array('text' => 'Monthly Average Temperature', 'x' => -20);
or
$chart->title->text = 'Monthly Average Temperature';
$chart->title->x = -20;
```

You can also create simple arrays

```php
$chart->series[] = array('name' => 'Tokyo', 'data' => array(7.0, 6.9, 9.5));
or  
$chart->series[0] = array('name' => 'Tokyo', 'data' => array(7.0, 6.9, 9.5));
or
$chart->series[0]->name = 'Tokyo';
$chart->series[0]->data = array(7.0, 6.9, 9.5);
```

### Render

To get all the script necessary to render your chart you can use the `printScripts()` method: 

```php
$chart->printScripts();
```

And finally to render the chart object use the `render()` method:

```php
echo $chart->render("chart");
```

The first (optional) argument passed to render method is the var name to be used by JavaScript and the second (optional) argument is the callback to be passed to the `Highcharts.Chart` method.

Its also possible to render the chart options only by calling the ```renderOptions()``` method. Useful for times where the chart is used inside a ```$.getJson``` call for example

```php
$.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=range.json&callback=?', function(data) {
    $('#container').highcharts(<?php echo $chart->renderOptions(); ?>)});
```

### Javascript expressions

If one of the chart options must be a JavaScript expression, you can't assign a simple string to it, otherwise it will be printed as a simple JavaScript string also. For that you must use the special `HighchartJsExpr` object:

```php
$chart->tooltip->formatter = new HighchartJsExpr("function() {
        return '' + this.series.name + this.x + ': ' + this.y + '°C';
    }"
);
```

### Empty javascript object {}
If you wish to render an empty javascript object ```{}```, just assign the variable you want with ```new stdClass()```

### Use new Highcharts 3.0 charts

Highcharts 3.0 introduced a new set of charts that require an additional javascript file ```highcharts-more.js```.

To include this extra script (and any script inside the ```extra``` key in ```config.php```) you need to call the ```includeExtraScripts()``` method.
```php
$chart = new Highchart();
$chart->includeExtraScripts();
```

### Render only some options
If you need to render a small portion of options, you can use the ``` HighchartOptionRenderer::render($options)``` method.

A good example of this can be found at [clock demo](https://github.com/ghunti/HighchartsPHP/blob/master/demos/highcharts/more_chart_types/clock.php)

```php
$backgroundOptions = new HighchartOption();
$backgroundOptions->radiaGradient = array(
    'cx' => 0.5,
    'cy' => -0.4,
    'r' => 1.9
);
...
$chart->pane->background[] = array(
    new stdClass(),
    array('backgroundColor' => new HighchartJsExpr('Highcharts.svg ? ' .
        HighchartOptionRenderer::render($backgroundOptions) . ' : null')
    )
);
```
This way it is possible to include option rendering inside a javascript expression

### Set up a general configuration

There are cases where a configuration is not created only for a chart, but for all the charts on the page ([lang](http://api.highcharts.com/highcharts#lang) and [global](http://api.highcharts.com/highcharts#global)) are examples of this.

To set a general option, just create a new ```HighchartOption``` (not chart) and send it to ```Highchart::setOptions()``` method.

The ```Highchart::setOptions()``` **must be placed before the chart render**

```php
$option = new HighchartOption();
$option->global->useUTC = false;
echo Highchart::setOptions($option);
```

### Themes

Theme creation follows the same process for a general option.
You create a new ```HighchartOption``` object, use it has if it was a chart and then call ```Highchart::setOptions()``` method.

```php
$theme = new HighchartOption();
//Code your theme as if this was a chart
$theme->colors = array('#058DC7', '#50B432', '#ED561B');
...
echo Highchart::setOptions($theme);
```

Demos
-----

All the Highcharts and Highstocks live demos present on http://www.highcharts.com under the demo gallery were reproduced using this library and you can find them on the demos folder or see a live example on http://www.goncaloqueiros.net/demos.php