<?php

namespace TestSuite\Twig\Extension;

use PHPUnit\Framework\TestCase;
use Twig\Loader\ArrayLoader;
use Twig\Environment;
use Twig\Extension\GeshiExtension;

class GeshiExtensionTest extends TestCase
{
    public function testGetNameReturnExtensionName()
    {
        $geshiExtension = new GeshiExtension();
        $this->assertEquals(
            'geshi',
            $geshiExtension->getName()
        );
    }

    public function testParseGeshiWithClassesEnabled()
    {
        $geshiExtension = new GeshiExtension();

        $test = '
            <?php
                echo \'test\';
            ?>
        ';
        $this->assertEquals(
            '<pre class="php">&nbsp;' . "\n"
                . '            <span class="kw2">&lt;?php</span>' . "\n"
                . '                <span class="kw1">echo</span> <span class="st_h">\'test\'</span><span class="sy0">;</span>' . "\n"
                . '            <span class="sy1">?&gt;</span>' . "\n"
                . '&nbsp;</pre>',
            $geshiExtension->parseGeshi($test, 'php', true)
        );
    }


    public function testParseGeshiThroughTwigTemplate()
    {
        $test = '
            <?php
                echo \'test\';
            ?>
        ';

        $loader = new ArrayLoader(['index' => '{{ "' . $test . '"|geshi(\'php\') }}']);
        $twig = new Environment($loader, ['debug' => true, 'cache' => false]);
        $twig->addExtension(new GeshiExtension());

        $template = $twig->load('index');
        $this->assertEquals(
            '<pre class="php" style="font-family:monospace;">&nbsp;' . "\n"
                . '            <span style="color: #000000; font-weight: bold;">&lt;?php</span>' . "\n"
                . '                <span style="color: #b1b100;">echo</span> <span style="color: #0000ff;">\'test\'</span><span style="color: #339933;">;</span>' . "\n"
                . '            <span style="color: #000000; font-weight: bold;">?&gt;</span>' . "\n"
                . '&nbsp;</pre>',
            $template->render([])
        );


        $loader = new ArrayLoader(['index' => '{{ content|geshi(\'php\') }}']);
        $twig = new Environment($loader, ['debug' => true, 'cache' => false]);
        $twig->addExtension(new GeshiExtension());

        $template = $twig->load('index');
        $this->assertEquals(
            '<pre class="php" style="font-family:monospace;">&nbsp;' . "\n"
                . '            <span style="color: #000000; font-weight: bold;">&lt;?php</span>' . "\n"
                . '                <span style="color: #b1b100;">echo</span> <span style="color: #0000ff;">\'test\'</span><span style="color: #339933;">;</span>' . "\n"
                . '            <span style="color: #000000; font-weight: bold;">?&gt;</span>' . "\n"
                . '&nbsp;</pre>',
            $template->render(['content' => $test])
        );
    }
}
