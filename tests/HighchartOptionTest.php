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

        $options->b = "B";
        $this->assertEquals("B", $options->b->getValue());
        $this->assertEquals(array('a' => "A", 'b' => "B"), $options->getValue());

        $options['a']['b'] = "AB";
        $this->assertEquals("AB", $options['a']['b']->getValue());
        $this->assertEquals(array('b' => "AB"), $options['a']->getValue());
        $this->assertEquals(array('a' => array('b' => "AB"), 'b' => "B"), $options->getValue());

        $options['a'] = "A";
        $this->assertEquals("A", $options['a']->getValue());
        $this->assertEquals(array('a' => "A", 'b' => "B"), $options->getValue());
        //--Consecutive creation

        //Non-consecutive creation
        $options = new HighchartOption();
        $options['a']['b']['c'] = "ABC";
        $this->assertEquals(array(
                            'a' => array(
                                'b' => array(
                                    'c' => "ABC"))),
                            $options->getValue());

        $options = new HighchartOption();
        $options->a->b->c = "ABC";
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
        $options->a[] = "A3";
        $this->assertEquals(array(
                             0  => "0",
                             1  => "1",
                            'a' => array("A1", "A2", "A3")),
                            $options->getValue());
        //--Non associative arrays

        //One-dimensional arrays as values
        $options = new HighchartOption();
        $options['a'] = array("A0", "A1");
        $options['b'] = array('a' => "BA", 'b' => "BB");
        $options['c'] = array('a' => "CA", "C0");
        $options->d = array("D0", "D1");
        $options->e = array('a' => "EA", 'b' => "EB");
        $options->f = array('a' => "FA", "F0");

        $this->assertEquals(array(
                            'a' => array("A0", "A1"),
                            'b' => array('a' => "BA", 'b' => "BB"),
                            'c' => array('a' => "CA", "C0"),
                            'd' => array("D0", "D1"),
                            'e' => array('a' => "EA", 'b' => "EB"),
                            'f' => array('a' => "FA", "F0")),
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
        $options->b = array(array("B00", "B01"),
                              'a' => array("BA0", "BA1"),
                              array('a' => "B1A", 'b' => "B1B"),
                              'b' => array('a' => "BBA", 'b' => "BBB"),
                              "2",
                              'c' => "C");

        $this->assertEquals(array(
                            'a' => array(
                                 0  => array("A00", "A01"),
                                 1  => array('a' => "A1A", 'b' => "A1B"),
                                 2  => "2",
                                'a' => array("AA0", "AA1"),
                                'b' => array('a' => "ABA", 'b' => "ABB"),
                                'c' => "C"),
                            'b' => array(
                                 0  => array("B00", "B01"),
                                 1  => array('a' => "B1A", 'b' => "B1B"),
                                 2  => "2",
                                'a' => array("BA0", "BA1"),
                                'b' => array('a' => "BBA", 'b' => "BBB"),
                                'c' => "C")),
                            $options->getValue());
        //--Multi-dimensional arrays as values

        //Array and object access
        $options = new HighchartOption();
        $options['a']->b['c'][] = "ABC0";
        $options->a['b']->c[] = "ABC1";
        $this->assertEquals(array(
                            'a' => array(
                                'b' => array(
                                    'c' => array("ABC0", "ABC1")))),
                            $options->getValue());
        //--Array and object access
    }
}
?>
