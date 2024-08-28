<?php

namespace TestSuite\Twig\Extension;

class GeshiExtensionTest extends \PHPUnit\Framework\TestCase
{
    protected $geshiExtension;

    protected function setUp(): void
    {
        $this->geshiExtension = new \Twig\Extension\GeshiExtension();
    }

    public function testGetNameReturnExtensionName()
    {
        $this->assertEquals(
            'geshi',
            $this->geshiExtension->getName()
        );
    }

    public function testParseGeshiWithClassesEnabled()
    {
        $sTest = '
            <?php
                echo \'test\';
            ?>
        ';
        $this->assertEquals(
            '<pre class="php">&nbsp;'. "\n" .
            '            <span class="kw2">&lt;?php</span>'. "\n" .
            '                <span class="kw1">echo</span> <span class="st_h">\'test\'</span><span class="sy0">;</span>'. "\n" .
            '            <span class="sy1">?&gt;</span>'. "\n" .
            '&nbsp;</pre>',
            $this->geshiExtension->parseGeshi($sTest, 'php', true)
        );
    }


    public function testParseGeshiThroughTwigTemplate()
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
        $this->assertEquals(
            '<pre class="php" style="font-family:monospace;">&nbsp;'. "\n" .
            '            <span style="color: #000000; font-weight: bold;">&lt;?php</span>'. "\n" .
            '                <span style="color: #b1b100;">echo</span> <span style="color: #0000ff;">\'test\'</span><span style="color: #339933;">;</span>'. "\n" .
            '            <span style="color: #000000; font-weight: bold;">?&gt;</span>'. "\n" .
            '&nbsp;</pre>',
            $oTemplate->render(array())
        );


        $oLoader = new \Twig_Loader_Array(array('index' => '{{ content|geshi(\'php\') }}'));
        $oTwig = new \Twig_Environment($oLoader, array('debug' => true, 'cache' => false));
        $oTwig->addExtension($this->geshiExtension);

        $oTemplate = $oTwig->loadTemplate('index');
        $this->assertEquals(
            '<pre class="php" style="font-family:monospace;">&nbsp;'. "\n" .
            '            <span style="color: #000000; font-weight: bold;">&lt;?php</span>'. "\n" .
            '                <span style="color: #b1b100;">echo</span> <span style="color: #0000ff;">\'test\'</span><span style="color: #339933;">;</span>'. "\n" .
            '            <span style="color: #000000; font-weight: bold;">?&gt;</span>'. "\n" .
            '&nbsp;</pre>',
            $oTemplate->render(array('content' => $sTest))
        );
    }
}
