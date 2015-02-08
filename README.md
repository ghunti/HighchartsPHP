HighchartsPHP
=============

HighchartsPHP is a PHP library that works as a wrapper for the **Highchart js** library (http://www.highcharts.com) and it was built with flexibility and maintainability in mind.
It isn't a simple port of the JavaScript library to PHP, it was designed in a way that mimics the JavaScript counterpart API, so that the developer only needs to learn one API.

The companion webpage can be found at http://www.goncaloqueiros.net/highcharts.php

Setup
-----

The recommended way to install HighchartsPHP is through  [`Composer`](http://getcomposer.org). Just create a ``composer.json`` file and run the ``php composer.phar install`` command to install it:
```json
{
    "require": {
        "ghunti/highcharts-php": "~3.0"
    }
}
```

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

Or if you don't want to directly echo the scripts and rather the function to return the script string:

```php
$chart->printScripts(true);
```

And finally to render the chart object use the `render()` method:

```php
echo $chart->render("chart");
```

The first (optional) argument passed to render method is the var name to be used by JavaScript and the second (optional) argument is the callback to be passed to the `Highcharts.Chart` method. The third and last (optional) argument flags that you want your script already wrapped around HTML script tags.

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

### Extra scripts

To manually include a script for render use the ```addExtraScript``` function:

```php
$chart->addExtraScript('export', 'http://code.highcharts.com/modules/', 'exporting.js');
```

To include an extra script use the key that's on the config file or that was given manually via ```addExtraScript```
```php
$chart->includeExtraScripts(array('export'));
```

To include more than one script just add it to the array
```php
$chart->includeExtraScripts(array('export', 'highcharts-more'));
```

If no arguments are passed, it will include all the extra scripts
```php
$chart->includeExtraScripts();
```

If you want to add any extra script to the default config file, feel free to open a PR. Here is the list of the current extra scripts available:
* [Highcharts 3.0 charts](http://www.highcharts.com/component/content/article/2-articles/news/54-highcharts-3-0-released/)
* [Exporting module](http://www.highcharts.com/docs/export-module/export-module-overview/)

### Use new Highcharts 3.0 charts

Highcharts 3.0 introduced a new set of charts that require an additional javascript file ```highcharts-more.js```.

To include this extra script you need to call the ```includeExtraScripts``` method with the **highcharts-more** key.
```php
$chart = new Highchart();
$chart->includeExtraScripts(array('highcharts-more'));
```

### Render only some options
If you need to render a small portion of options, you can use the ``` HighchartOptionRenderer::render($options)``` method.

A good example of this can be found at [clock demo](https://github.com/ghunti/HighchartsPHP/blob/master/demos/highcharts/more_chart_types/clock.php)

```php
$backgroundOptions = new HighchartOption();
$backgroundOptions->radialGradient = array(
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

### Configuration
By default HighchartsPHP library comes with configurations to work out of the box. If you wish to change the path of any js library loaded, have a look at ``src/config.php``.
In case you need to change some of this values you should use the ``setConfigurations`` method:
```php
$chart = new Highchart();
$chart->setConfigurations(
    array(
        'jQuery' => array(
            'name' => 'anotherName'
        )
    )
);
```

Demos
-----

All the Highcharts and Highstocks live demos present on http://www.highcharts.com under the demo gallery were reproduced using this library and you can find them on the demos folder or see a live example on http://www.goncaloqueiros.net/demos.php

Tests
-----
You can run the unit tests with the following command:
```bash
$ cd path/to/HighchartsPHP/
$ composer.phar install
$ phpunit
```
