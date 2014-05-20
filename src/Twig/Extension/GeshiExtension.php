<?php

namespace Twig\Extension;

class GeshiExtension extends \Twig_Extension
{

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            'geshi' => new \Twig_Filter_Method(
                    $this, 'parseGeshi', array('is_safe' => array('html'))
            )
        );
    }

    /**
     * @param string $sContent
     * @param string $sLanguage
     * @return string
     */
    public function parseGeshi($sContent, $sLanguage, $bUseClasses = false)
    {
        $oGeshi = new \GeSHi($sContent, $sLanguage);
        if ($bUseClasses) {
            $oGeshi->enable_classes();
        }
        return $oGeshi->parse_code();
    }

    /**
     * @return array
     */
    public function getTokenParsers()
    {
        return array(new \Twig\TokenParser\GeshiTokenParser());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'geshi';
    }

}
