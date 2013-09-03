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

### Javascript expressions

If one of the chart options must be a JavaScript expression, you can't assign a simple string to it, otherwise it will be printed as a simple JavaScript string also. For that you must use the special `HighchartJsExpr` object:

```php
$chart->tooltip->formatter = new HighchartJsExpr("function() {
        return '' + this.series.name + this.x + ': ' + this.y + '°C';
    }"
);
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

Demos
-----

All the Highcharts and Highstocks live demos present on http://www.highcharts.com under the demo gallery were reproduced using this library and you can find them on the demos folder or see a live example on http://www.goncaloqueiros.net/demos.php