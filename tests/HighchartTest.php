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
        $chart->test->utf8String = "áù anything ü";
        $chart->test->iso88591 = iconv(
            "UTF-8",
            "ISO-8859-1",
            "Ã¡Ã¹ anything Ã¼"
        );

        $result = $chart->renderOptions();
        $this->assertEquals('{"test":{"utf8String":"\u00e1\u00f9 anything \u00fc","iso88591":"\u00e1\u00f9 anything \u00fc"}}', $result);
    }
}
?>
