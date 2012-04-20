<?php

include_once "HighchartOption.php";

class Highchart implements ArrayAccess {
    private $_options = array();

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
}
