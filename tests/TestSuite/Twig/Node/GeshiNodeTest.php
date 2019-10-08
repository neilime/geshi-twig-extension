<?php

namespace TestSuite\Twig\TokenParser;

class GeshiNodeTest extends \Twig_Test_NodeTestCase
{

    public function testConstructor()
    {
        $aParams = array(
            'language' => 'php',
            'line_numbers' => false,
            'use_classes' => false,
            'class' => false,
            'id' => false
        );
        $sTest = '<?php' . "\n" . 'echo "test";' . "\n" . '?>';

        $oBody = new \Twig_Node(array(new \Twig_Node_Text($sTest, 1)));
        $oNode = new \Twig\Node\GeshiNode($aParams, $oBody, 1, 'geshi');

        $this->assertEquals($oBody, $oNode->getNode('body'));
    }

    
    /**
     * Test that the generated code looks as expected
     *
     * @dataProvider getTests
     */
    public function testCompile($oNode, $source, $environment = null, $isPattern = false)
    {
        $source = str_replace("\r\n", "\n", $source);
        parent::testCompile($oNode, $source, $environment, $isPattern);
    }

    public function getTests()
    {
        $aTests = array();

        $aParams = array(
            'language' => 'php',
            'line_numbers' => true,
            'use_classes' => true,
            'class' => true,
            'id' => true
        );

        $oBody = new \Twig_Node(array(new \Twig_Node_Text('<?php' . "\n" . 'echo "test";  ' . "\n" . '?> ', 1)));
        $oNode = new \Twig\Node\GeshiNode($aParams, $oBody, 1, 'geshi');

        $aTests['simple_text'] = array(
            $oNode, 
            str_replace("\r\n", "\n", file_get_contents(__DIR__ . '/../../../_files/expected/simple-text.html'))
        );

        $oBody = new \Twig_Node(array(new \Twig_Node_Text('<?php' . "\n" . 'echo "test";' . "\n" . '?>', 1)));
        $oNode = new \Twig\Node\GeshiNode($aParams, $oBody, 1, 'geshi');

        $compiler = $this->getCompiler(null);
        $compiler->compile($oNode);

        $aTests['text_with_leading_indent'] = array(
            $oNode, 
            str_replace("\r\n", "\n", file_get_contents(__DIR__ . '/../../../_files/expected/text-with-leading-indent.html'))
        );

        return $aTests;
    }

}
