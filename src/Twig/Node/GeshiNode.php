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
                ->write('ob_start();' . "\n")
                ->subcompile($this->getNode('body'))
                ->write('$sSource = rtrim(ob_get_clean());' . "\n")
                ->write('$oGeshi = new \GeSHi($sSource, \'' . $this->getAttribute('language') . '\');' . "\n");
        if ($this->getAttribute('use_classes')) {
            $oCompiler->write('$oGeshi->enable_classes();' . "\n");
        }
        if ($this->getAttribute('line_numbers')) {
            $oCompiler->write('$oGeshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);' . "\n");
        }
        if ($this->getAttribute('class')) {
            $oCompiler->write('$oGeshi->set_overall_class(\'' . $this->getAttribute('class') . '\');' . "\n");
        }
        if ($this->getAttribute('id')) {
            $oCompiler->write('$oGeshi->set_overall_id(\'' . $this->getAttribute('id') . '\');' . "\n");
        }
        $oCompiler->write('echo $oGeshi->parse_code() . PHP_EOL;' . "\n");
    }

}
