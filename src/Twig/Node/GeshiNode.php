<?php

namespace Twig\Node;

/**
 * Represents a Geshi node, it parses content as Geshi.
 */
class GeshiNode extends \Twig_Node
{

    /**
     * Constructor
     * @param array $aParams
     * @param string $sBody
     * @param int $iLine
     * @param string $sTag
     */
    public function __construct($aParams, $sBody, $iLine, $sTag)
    {
        parent::__construct(array('body' => $sBody), $aParams, $iLine, $sTag);
    }

    /**
     * @param \Twig_Compiler $oCompiler
     */
    public function compile(\Twig_Compiler $oCompiler)
    {
        $oCompiler
                ->addDebugInfo($this)
                ->write('ob_start();' . PHP_EOL)
                ->subcompile($this->getNode('body'))
                ->write('$sSource = rtrim(ob_get_clean());' . PHP_EOL)
                ->write('$oGeshi = new \GeSHi($sSource, \'' . $this->getAttribute('language') . '\');' . PHP_EOL);
        if ($this->getAttribute('use_classes')) {
            $oCompiler->write('$oGeshi->enable_classes();' . PHP_EOL);
        }
        if ($this->getAttribute('line_numbers')) {
            $oCompiler->write('$oGeshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);' . PHP_EOL);
        }
        if ($this->getAttribute('class')) {
            $oCompiler->write('$oGeshi->set_overall_class(\'' . $this->getAttribute('class') . '\');' . PHP_EOL);
        }
        if ($this->getAttribute('id')) {
            $oCompiler->write('$oGeshi->set_overall_id(\'' . $this->getAttribute('id') . '\');' . PHP_EOL);
        }
        $oCompiler->write('echo $oGeshi->parse_code() . PHP_EOL;' . PHP_EOL);
    }

}
