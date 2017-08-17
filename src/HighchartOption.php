<?php
/**
*
* Copyright 2012-2012 Portugalmail Comunicações S.A (http://www.portugalmail.net/)
*
* See the enclosed file LICENCE for license information (GPLv3). If you
* did not receive this file, see http://www.gnu.org/licenses/gpl-3.0.html.
*
* @author Gonçalo Queirós <mail@goncaloqueiros.net>
*/

class HighchartOption implements ArrayAccess
{
    /**
     * An array of HighchartOptions
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

    /**
     * Clone HighchartOption object
     */
    public function __clone()
    {
	$thischilds=$this->_childs;
        foreach ($thischilds as $key => $value)
        {
            $this->_childs[$key] = clone $value;
        }
    }

    /**
     * The HighchartOption constructor
     *
     * @param mixed $value The option value
     */
    public function __construct($value = null)
    {
        if (is_string($value)) {
            //Avoid json-encode errors latter on
            if(function_exists('iconv')){
                $this->_value = iconv(
                        mb_detect_encoding($value),
                        "UTF-8",
                        $value
                );
            } else {// fallback for servers that does not have iconv  
                $this->_value = mb_convert_encoding($value, "UTF-8", mb_detect_encoding($value));
            }
        } else if (!is_array($value)) {
            $this->_value = $value;
        } else {
            foreach($value as $key => $val) {
                $this->offsetSet($key, $val);
            }
        }
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
	    $thischilds=$this->_childs;
            foreach ($thischilds as $key => $value) {
                $result[$key] = $value->getValue();
            }
            return $result;
        }
        return null;
    }

    public function __set($offset, $value)
    {
        $this->offsetSet($offset, $value);
    }

    public function __get($offset)
    {
        return $this->offsetGet($offset);
    }

    public static function createNew($value)
    {
	return new HighchartOption($value);
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->_childs[] = self::createNew($value);
        } else {
            $this->_childs[$offset] = self::createNew($value);
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
            $this->_childs[] = self::createNew();
            return end($this->_childs);
        }
        if (!isset($this->_childs[$offset])) {
            $this->_childs[$offset] = self::createNew();
        }
        return $this->_childs[$offset];
    }
}
