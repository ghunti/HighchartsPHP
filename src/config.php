<?php

/**
 * Paths and names for the javascript libraries needed by higcharts/highstock charts
 */
$jsFiles = array(
    'jQuery' => array(
        'name' => 'jquery-2.1.3.min.js',
        'path' => '//code.jquery.com/'
    ),

    'mootools' => array(
        'name' => 'mootools-yui-compressed.js',
        'path' => '//ajax.googleapis.com/ajax/libs/mootools/1.4.5/'
    ),

    'prototype' => array(
        'name' => 'prototype.js',
        'path' => '//ajax.googleapis.com/ajax/libs/prototype/1.7.0.0/'
    ),

    'highcharts' => array(
        'name' => 'highcharts.js',
        'path' => '//code.highcharts.com/'
    ),

    'highchartsMootoolsAdapter' => array(
        'name' => 'mootools-adapter.js',
        'path' => '//code.highcharts.com/adapters/'
    ),

    'highchartsPrototypeAdapter' => array(
        'name' => 'prototype-adapter.js',
        'path' => '//code.highcharts.com/adapters/'
    ),

    'highstock' => array(
        'name' => 'highstock.js',
        'path' => '//code.highcharts.com/stock/'
    ),

    'highstockMootoolsAdapter' => array(
        'name' => 'mootools-adapter.js',
        'path' => '//code.highcharts.com/stock/adapters/'
    ),

    'highstockPrototypeAdapter' => array(
        'name' => 'prototype-adapter.js',
        'path' => '//code.highcharts.com/stock/adapters/'
    ),

    'highmaps' => array(
        'name' => 'highmaps.js',
        'path' => '//code.highcharts.com/maps/'
    ),

    //Extra scripts used by Highcharts 3.0 charts
    'extra' => array(
        'highcharts-more' => array(
            'name' => 'highcharts-more.js',
            'path' => '//code.highcharts.com/'
        ),
        'exporting' => array(
            'name' => 'exporting.js',
            'path' => '//code.highcharts.com/modules/'
        ),
    )
);
