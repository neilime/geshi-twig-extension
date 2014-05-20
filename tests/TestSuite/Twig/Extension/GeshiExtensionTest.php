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
        $oTwig->addExtension(new \Twig\Extension\GeshiExtension());

        $oTemplate = $oTwig->loadTemplate('index');
        $this->assertEquals('<pre class="php" style="font-family:monospace;">&nbsp;
            <span style="color: #000000; font-weight: bold;">&lt;?php</span>
                <span style="color: #b1b100;">echo</span> <span style="color: #0000ff;">\'test\'</span><span style="color: #339933;">;</span>
            <span style="color: #000000; font-weight: bold;">?&gt;</span>
&nbsp;</pre>', $oTemplate->render(array()));


        $oLoader = new \Twig_Loader_Array(array('index' => '{{ content|geshi(\'php\') }}'));
        $oTwig = new \Twig_Environment($oLoader, array('debug' => true, 'cache' => false));
        $oTwig->addExtension(new \Twig\Extension\GeshiExtension());

        $oTemplate = $oTwig->loadTemplate('index');
        $this->assertEquals('<pre class="php" style="font-family:monospace;">&nbsp;
            <span style="color: #000000; font-weight: bold;">&lt;?php</span>
                <span style="color: #b1b100;">echo</span> <span style="color: #0000ff;">\'test\'</span><span style="color: #339933;">;</span>
            <span style="color: #000000; font-weight: bold;">?&gt;</span>
&nbsp;</pre>', $oTemplate->render(array('content' => $sTest)));
    }

}
