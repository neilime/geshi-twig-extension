<?php

namespace TestSuite\Twig\Extension;

class GeshiExtensionTest extends \PHPUnit_Framework_TestCase
{

    public function testParseGeshi()
    {

        $sTest = '
            <?php
                echo \'test\';
            ?>
        ';

        $oLoader = new \Twig_Loader_Array(array('index' => '{{ "' . $sTest . '"|geshi(\'php\') }}'));
        $oTwig = new \Twig_Environment($oLoader, array('debug' => true, 'cache' => false));
        $oTwig->addExtension(new \Twig\Extension\GeshiExtension(new \Twig\Extension\GeshiEngine()));

        $oTemplate = $oTwig->loadTemplate('index');
        $this->assertEquals('<pre class="php">&nbsp;
            <span class="kw2">&lt;?php</span>
                <span class="kw1">echo</span> <span class="st_h">\'test\'</span><span class="sy0">;</span>
            <span class="sy1">?&gt;</span>
&nbsp;</pre>', $oTemplate->render(array()));


        $oLoader = new \Twig_Loader_Array(array('index' => '{{ content|geshi(\'php\') }}'));
        $oTwig = new \Twig_Environment($oLoader, array('debug' => true, 'cache' => false));
        $oTwig->addExtension(new \Twig\Extension\GeshiExtension(new \Twig\Extension\GeshiEngine()));

        $oTemplate = $oTwig->loadTemplate('index');
        $this->assertEquals('<pre class="php">&nbsp;
            <span class="kw2">&lt;?php</span>
                <span class="kw1">echo</span> <span class="st_h">\'test\'</span><span class="sy0">;</span>
            <span class="sy1">?&gt;</span>
&nbsp;</pre>', $oTemplate->render(array('content' => $sTest)));
    }

}
