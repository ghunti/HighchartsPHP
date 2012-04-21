<?php

class HighchartJsExpr
{
    /**
     * The javascript expression
     *
     * @var string
     */
    private $_expression;

    public function __construct($expression)
    {
        $this->_expression = $expression;
    }

    public function getExpression()
    {
        return $this->_expression;
    }
}