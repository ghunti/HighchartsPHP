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
include_once dirname(__FILE__) . "/../Highchart.php";

class HighchartTest extends PHPUnit_Framework_TestCase
{
    public function testRenderOptionsEncoding()
    {
        //Check for encoding problems
        $chart = new Highchart();
        $chart->test->utf8String = utf8_encode("áù anything ü");
        $chart->test->iso88591 = utf8_decode(utf8_encode("áù anything ü"));

        $result = $chart->renderOptions();
        $this->assertEquals('{"test":{"utf8String":"\u00c3\u0083\u00c2\u00a1\u00c3\u0083\u00c2\u00b9 anything \u00c3\u0083\u00c2\u00bc","iso88591":"\u00c3\u00a1\u00c3\u00b9 anything \u00c3\u00bc"}}', $result);
    }
}
?>
