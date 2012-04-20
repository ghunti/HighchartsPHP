<?php

include_once "HighchartOption.php";

class Highchart implements ArrayAccess
{
    //The chart type.
    //A regullar higchart
    const HIGHCHART = 0;
    //A highstock chart
    const HIGHSTOCK = 1;

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

    public function __construct($chartType = self::HIGHCHART)
    {
        $this->_chartType = $chartType;
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
        $options = array();
        foreach ($this->_options as $key => $value) {
            $options[$key] = $value->getValue();
        }
        //TODO: Check for encoding errors
        return json_encode($options);
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
}
