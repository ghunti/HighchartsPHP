<?php

include_once "HighchartOption.php";
include_once "HighchartJsExpr.php";

class Highchart implements ArrayAccess
{
    //The chart type.
    //A regullar higchart
    const HIGHCHART = 0;
    //A highstock chart
    const HIGHSTOCK = 1;

    //The js engine to use
    const ENGINE_JQUERY = 10;
    const ENGINE_MOOTOOLS = 11;
    const ENGINE_PROTOTYPE = 12;

    /**
     * The chart options
     *
     * @var array
     */
    private $_options = array();

    /**
     * The chart type.
     * Either self::HIGHCHART or self::HIGHSTOCK
     *
     * @var int
     */
    private $_chartType;

    /**
     * The javascript library to use.
     * One of ENGINE_JQUERY, ENGINE_MOOTOOLS or ENGINE_PROTOTYPE
     *
     * @var int
     */
    private $_jsEngine;

    public function __construct($chartType = self::HIGHCHART, $jsEngine = self::ENGINE_JQUERY)
    {
        $this->_chartType = $chartType;
        $this->_jsEngine = $jsEngine;
    }

    public function __set($offset, $value)
    {
        $this->offsetSet($offset, $value);
    }

    public function __get($offset)
    {
        return $this->offsetGet($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->_options[$offset] = new HighchartOption($value);
    }

    public function offsetExists($offset)
    {
        return isset($this->_options[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->_options[$offset]);
    }

    public function offsetGet($offset)
    {
        if (!isset($this->_options[$offset])) {
            $this->_options[$offset] = new HighchartOption();
        }
        return $this->_options[$offset];
    }

    public function renderOptions()
    {
        $jsExpressions = array();
        //Replace any js expression with random strings so we can switch
        //them back after json_encode the options
        $options = self::_replaceJsExpr($this->_options, $jsExpressions);

        //TODO: Check for encoding errors
        $result = json_encode($options);

        //Replace any js expression on the json_encoded string
        foreach ($jsExpressions as $key => $expr) {
            $result = str_replace('"' . $key . '"', $expr, $result);
        }
        return $result;
    }

    /**
     * Replaces any HighchartJsExpr for an id, and save the
     * js expression on the jsExpressions array
     * Based on Zend_Json
     *
     * @param mixed $data           The data to analyze
     * @param array &$jsExpressions The array that will hold
     *                              information about the replaced
     *                              js expressions
     */
    private static function _replaceJsExpr($data, &$jsExpressions)
    {
        if ($data instanceof HighchartJsExpr) {
            $magicKey = "____" . count($jsExpressions) . "_" . count($jsExpressions);
            $jsExpressions[$magicKey] = $data->getExpression();
            return $magicKey;
        }

        if (!is_array($data) &&
            !is_object($data)) {
            return $data;
        }

        if (is_object($data)) {
            $data = $data->getValue();
        }

        foreach ($data as $key => $value) {
            $data[$key] = self::_replaceJsExpr($value, $jsExpressions);
        }
        return $data;
    }

    /**
     * Render the chart and returns the javascript that
     * must be printed to the page to create the chart
     *
     * @param string $varName The javascript chart variable name
     *
     * @return string The javascript code
     */
    public function render($varName = null)
    {
        $result = '';
        if (!is_null($varName)) {
            $result = "$varName = ";
        }

        $result .= 'new Highcharts.';
        if ($this->_chartType === self::HIGHCHART) {
            $result .= 'Chart(';
        } else {
            $result .= 'StockChart(';
        }

        $result .= $this->renderOptions();
        $result .= ');';
        return $result;
    }

    /**
     * Finds the javascript files that need to be included on the page, based
     * on the chart type and js engine.
     * Uses the conf.php file to build the files path
     *
     * @return array The javascript files path
     */
    public function getScripts()
    {
        include_once "conf.php";

        $scripts = array();
        switch ($this->_jsEngine) {
            case self::ENGINE_JQUERY:
                $scripts[] = $jsFiles['jQuery']['path'] . $jsFiles['jQuery']['name'];
                break;

            case self::ENGINE_MOOTOOLS:
                $scripts[] = $jsFiles['mootools']['path'] . $jsFiles['mootools']['name'];
                if ($this->_chartType === self::HIGHCHART) {
                    $scripts[] = $jsFiles['highchartsMootoolsAdapter']['path'] . $jsFiles['highchartsMootoolsAdapter']['name'];
                } else {
                    $scripts[] = $jsFiles['highstockMootoolsAdapter']['path'] . $jsFiles['highstockMootoolsAdapter']['name'];
                }
                break;

            case self::ENGINE_PROTOTYPE:
                $scripts[] = $jsFiles['prototype']['path'] . $jsFiles['prototype']['name'];
                if ($this->_chartType === self::HIGHCHART) {
                    $scripts[] = $jsFiles['highchartsPrototypeAdapter']['path'] . $jsFiles['highchartsPrototypeAdapter']['name'];
                } else {
                    $scripts[] = $jsFiles['highstockPrototypeAdapter']['path'] . $jsFiles['highstockPrototypeAdapter']['name'];
                }
                break;

        }

        switch ($this->_chartType) {
            case self::HIGHCHART:
                $scripts[] = $jsFiles['highcharts']['path'] . $jsFiles['highcharts']['name'];
                break;

            case self::HIGHSTOCK:
                $scripts[] = $jsFiles['highstock']['path'] . $jsFiles['highstock']['name'];
                break;
        }

        return $scripts;
    }
}
