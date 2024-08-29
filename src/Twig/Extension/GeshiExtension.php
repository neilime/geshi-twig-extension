<?php

namespace Twig\Extension;

use GeSHi;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class GeshiExtension extends AbstractExtension
{
    /**
     * @return TwigFilter[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('geshi', [$this, 'parseGeshi'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param string $content
     * @param string $language
     * @param bool $useClasses
     * @return string
     */
    public function parseGeshi($content, $language, $useClasses = false)
    {
        $geshi = new GeSHi($content, $language);
        if ($useClasses) {
            $geshi->enable_classes();
        }
        $code = $geshi->parse_code();
        return $code;
    }

    /**
     * @return array{}
     */
    public function getTokenParsers()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'geshi';
    }
}
