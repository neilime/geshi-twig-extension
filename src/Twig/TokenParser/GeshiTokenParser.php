<?php

namespace Twig\TokenParser;

class GeshiTokenParser extends \Twig_TokenParser
{

    /**
     * @param \Twig_Token $oToken
     * @return \Twig\Node\GeshiNode
     * @throws \Twig_Error_Syntax
     */
    public function parse(\Twig_Token $oToken)
    {
        $aParams = array(
            'language' => false,
            'line_numbers' => false,
            'use_classes' => false,
            'class' => false,
            'id' => false
        );

        $iLine = $oToken->getLine();
        $oStream = $this->parser->getStream();
        $aParams['language'] = $oStream->expect(\Twig_Token::STRING_TYPE)->getValue();
        while ($oStream->test(\Twig_Token::BLOCK_END_TYPE) == false) {
            $sArgName = $oStream->expect(\Twig_Token::NAME_TYPE)->getValue();
            if (!isset($aParams[$sArgName])) {
                throw new \Twig_Error_Syntax('"' . $sArgName . '" is not a valid argument for the GeSHi tag.', $iLine);
            }
            if (in_array($sArgName, array('class', 'id'))) {
                $sOperator = $oStream->expect(\Twig_Token::OPERATOR_TYPE)->getValue();
                if ($sOperator != '=') {
                    throw new \Twig_Error_Syntax('"' . $sArgName . '" must be followed by an equal sign and a value.', $iLine);
                }
                $sArgValue = $oStream->expect(\Twig_Token::STRING_TYPE)->getValue();
                $aParams[$sArgName] = $sArgValue;
            } else {
                $aParams[$sArgName] = true;
            }
        }
        $oStream->expect(\Twig_Token::BLOCK_END_TYPE);
        $sBody = $this->parser->subparse(array($this, 'decideBlockEnd'), true);
        $oStream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new \Twig\Node\GeshiNode($aParams, $sBody, $iLine, $this->getTag());
    }

    public function decideBlockEnd(\Twig_Token $oToken)
    {
        return $oToken->test('endgeshi');
    }

    /**
     * Gets the tag name associated with this token parser.
     * @return string
     */
    public function getTag()
    {
        return 'geshi';
    }

}
