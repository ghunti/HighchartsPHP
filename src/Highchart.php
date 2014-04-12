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

namespace Ghunti\HighchartsPHP;

use Ghunti\HighchartsPHP\HighchartOption;
use Ghunti\HighchartsPHP\HighchartOptionRenderer;

class Highchart implements \ArrayAccess
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
    protected $_options = array();

    /**
     * The chart type.
     * Either self::HIGHCHART or self::HIGHSTOCK
     *
     * @var int
     */
    protected $_chartType;

    /**
     * The javascript library to use.
     * One of ENGINE_JQUERY, ENGINE_MOOTOOLS or ENGINE_PROTOTYPE
     *
     * @var int
     */
    protected $_jsEngine;

    /**
     * Whether or not to include the scripts specified under the extra key on the config file
     *
     * @var boolean
     */
    protected $_extraScripts = false;

    /**
     * Any configurations to use instead of the default ones
     *
     * @var array An array with same structure as the config.php file
     */
    protected $_confs = array();

    /**
     * The Highchart constructor
     *
     * @param int $chartType The chart type (Either self::HIGHCHART or self::HIGHSTOCK)
     * @param int $jsEngine  The javascript library to use
     *                       (One of ENGINE_JQUERY, ENGINE_MOOTOOLS or ENGINE_PROTOTYPE)
     */
    public function __construct($chartType = self::HIGHCHART, $jsEngine = self::ENGINE_JQUERY, $extraScripts = false)
    {
        $this->_chartType = is_null($chartType) ? self::HIGHCHART : $chartType;
        $this->_jsEngine = is_null($jsEngine) ? self::ENGINE_JQUERY : $jsEngine;
        $this->_extraScripts = $extraScripts;
        //Load default configurations
        $this->setConfigurations();
    }

    /**
     * Override default configuration values with the ones provided.
     * The provided array should have the same structure as the config.php file.
     * If you wish to override a single value you would pass something like:
     *     $chart = new Highchart();
     *     $chart->setConfigurations(array('jQuery' => array('name' => 'newFile')));
     *
     * @param array $configurations The new configuration values
     */
    public function setConfigurations($configurations = array())
    {
        include __DIR__ . DIRECTORY_SEPARATOR . "config.php";
        $this->_confs = array_replace_recursive($jsFiles, $configurations);
    }

    /**
     * Render the chart options and returns the javascript that
     * represents them
     *
     * @return string The javascript code
     */
    public function renderOptions()
    {
        return HighchartOptionRenderer::render($this->_options);
    }

    /**
     * Render the chart and returns the javascript that
     * must be printed to the page to create the chart
     *
     * @param string $varName The javascript chart variable name
     * @param string $callback The function callback to pass
     *                         to the Highcharts.Chart method
     *
     * @return string The javascript code
     */
    public function render($varName = null, $callback = null)
    {
        $result = '<script type="text/javascript">';
        if (!is_null($varName)) {
            $result .= "$varName = ";
        }

        $result .= 'new Highcharts.';
        if ($this->_chartType === self::HIGHCHART) {
            $result .= 'Chart(';
        } else {
            $result .= 'StockChart(';
        }

        $result .= $this->renderOptions();
        $result .= is_null($callback) ? '' : ", $callback";
        $result .= ');';
        $result .= '</script>';
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
        $scripts = array();
        switch ($this->_jsEngine) {
            case self::ENGINE_JQUERY:
                $scripts[] = $this->_confs['jQuery']['path'] . $this->_confs['jQuery']['name'];
                break;

            case self::ENGINE_MOOTOOLS:
                $scripts[] = $this->_confs['mootools']['path'] . $this->_confs['mootools']['name'];
                if ($this->_chartType === self::HIGHCHART) {
                    $scripts[] = $this->_confs['highchartsMootoolsAdapter']['path'] . $this->_confs['highchartsMootoolsAdapter']['name'];
                } else {
                    $scripts[] = $this->_confs['highstockMootoolsAdapter']['path'] . $this->_confs['highstockMootoolsAdapter']['name'];
                }
                break;

            case self::ENGINE_PROTOTYPE:
                $scripts[] = $this->_confs['prototype']['path'] . $this->_confs['prototype']['name'];
                if ($this->_chartType === self::HIGHCHART) {
                    $scripts[] = $this->_confs['highchartsPrototypeAdapter']['path'] . $this->_confs['highchartsPrototypeAdapter']['name'];
                } else {
                    $scripts[] = $this->_confs['highstockPrototypeAdapter']['path'] . $this->_confs['highstockPrototypeAdapter']['name'];
                }
                break;

        }

        switch ($this->_chartType) {
            case self::HIGHCHART:
                $scripts[] = $this->_confs['highcharts']['path'] . $this->_confs['highcharts']['name'];
                break;

            case self::HIGHSTOCK:
                $scripts[] = $this->_confs['highstock']['path'] . $this->_confs['highstock']['name'];
                break;
        }

        //Include all scripts under the 'extra' key on config file
        if ($this->_extraScripts === true) {
            foreach ($this->_confs['extra'] as $scriptInfo) {
                $scripts[] = $scriptInfo['path'] . $scriptInfo['name'];
            }
        }

        return $scripts;
    }

    /**
     * Prints javascript script tags for all scripts that need to be included on page
     */
    public function printScripts()
    {
        foreach ($this->getScripts() as $script) {
            echo '<script type="text/javascript" src="' . $script . '"></script>';
        }
    }

    /**
     * Mark extra javascript scripts to be included on the page
     */
    public function includeExtraScripts()
    {
        $this->_extraScripts = true;
    }

    /**
     * Global options that don't apply to each chart like lang and global
     * must be set using the Highcharts.setOptions javascript method.
     * This method receives a set of HighchartOption and returns the
     * javascript string needed to set those options globally
     *
     * @param HighchartOption The options to create
     *
     * @return string The javascript needed to set the global options
     */
    public static function setOptions($options)
    {
        //TODO: Check encoding errors
        $option = json_encode($options->getValue());
        return "Highcharts.setOptions($option);";
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
}
