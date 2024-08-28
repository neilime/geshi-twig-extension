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
            new \Twig_SimpleFilter('geshi', array($this, 'parseGeshi'), array('is_safe' => array('html'))),
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
        $sCode = $oGeshi->parse_code();
        return $sCode;
    }

    /**
     * @return array
     */
    public function getTokenParsers()
    {
        return array();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'geshi';
    }
}
