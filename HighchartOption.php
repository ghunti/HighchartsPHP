<?php

class HighChartOption implements ArrayAccess
{
    /**
     * An array of HighChartOptions
     *
     * @var array
     */
    private $_childs = array();

    /**
     * The option value
     *
     * @var mixed
     */
    private $_value;

    public function __construct($value = null)
    {
        if (!is_array($value)) {
            $this->_value = $value;
        } else {
            foreach($value as $key => $val) {
                $this->offsetSet($key, $val);
            }
        }
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->_childs[] = new self($value);
        } else {
            $this->_childs[$offset] = new self($value);
        }
        //If the option has at least one child, then it won't
        //have a final value
        unset($this->_value);
    }

    public function offsetExists($offset)
    {
        return isset($this->_childs[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->_childs[$offset]);
    }

    public function offsetGet($offset)
    {
        //Unset the value, because we will always
        //have at least one child at the end of
        //this method
        unset($this->_value);
        if (is_null($offset)) {
            $this->_childs[] = new self();
            return end($this->_childs);
        }
        if (!isset($this->_childs[$offset])) {
            $this->_childs[$offset] = new self();
        }
        return $this->_childs[$offset];
    }

    /**
     * Returns the value of the current option
     *
     * @return mixed The option value
     */
    public function getValue()
    {
        if (isset($this->_value)) {
            //This is a final option
            return $this->_value;
        } elseif (!empty($this->_childs)) {
            //The option value is an array
            $result = array();
            foreach ($this->_childs as $key => $value) {
                $result[$key] = $value->getValue();
            }
            return $result;
        }
        return null;
    }
}