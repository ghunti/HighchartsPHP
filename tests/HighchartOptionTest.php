<?php

include_once dirname(__FILE__) . "/../HighchartOption.php";

class HighchartOptionTest extends PHPUnit_Framework_TestCase
{
    public function testOptionCreation()
    {
        //Consecutive creation
        $options = new HighchartOption();
        $options['a'] = "A";
        $this->assertEquals("A", $options['a']->getValue());
        $this->assertEquals(array('a' => "A"), $options->getValue());

        $options['a']['b'] = "AB";
        $this->assertEquals("AB", $options['a']['b']->getValue());
        $this->assertEquals(array('b' => "AB"), $options['a']->getValue());
        $this->assertEquals(array('a' => array('b' => "AB")), $options->getValue());

        $options['a'] = "A";
        $this->assertEquals("A", $options['a']->getValue());
        $this->assertEquals(array('a' => "A"), $options->getValue());
        //--Consecutive creation

        //Non-consecutive creation
        $options = new HighchartOption();
        $options['a']['b']['c'] = "ABC";
        $this->assertEquals(array(
                            'a' => array(
                                'b' => array(
                                    'c' => "ABC"))),
                            $options->getValue());
        //--Non-consecutive creation

        //Non associative arrays
        $options = new HighchartOption();
        $options[] = "0";
        $options[] = "1";
        $options['a'][] = "A1";
        $options['a'][] = "A2";
        $this->assertEquals(array(
                             0  => "0",
                             1  => "1",
                            'a' => array("A1", "A2")),
                            $options->getValue());
        //--Non associative arrays

        //One-dimensional arrays as values
        $options = new HighchartOption();
        $options['a'] = array("A0", "A1");
        $options['b'] = array('a' => "BA", 'b' => "BB");
        $options['c'] = array('a' => "CA", "C0");

        $this->assertEquals(array(
                            'a' => array("A0", "A1"),
                            'b' => array('a' => "BA", 'b' => "BB"),
                            'c' => array('a' => "CA", "C0")),
                            $options->getValue());
        //--One-dimensional arrays as values

        //Multi-dimensional arrays as values
        $options = new HighchartOption();
        $options['a'] = array(array("A00", "A01"),
                              'a' => array("AA0", "AA1"),
                              array('a' => "A1A", 'b' => "A1B"),
                              'b' => array('a' => "ABA", 'b' => "ABB"),
                              "2",
                              'c' => "C");

        $this->assertEquals(array(
                            'a' => array(
                                 0  => array("A00", "A01"),
                                 1  => array('a' => "A1A", 'b' => "A1B"),
                                 2  => "2",
                                'a' => array("AA0", "AA1"),
                                'b' => array('a' => "ABA", 'b' => "ABB"),
                                'c' => "C")),
                            $options->getValue());
        //--Multi-dimensional arrays as values
    }
}
?>