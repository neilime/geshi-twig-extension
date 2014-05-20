<?php

namespace TestSuite\Twig\TokenParser;

class GeshiTokenParserTest extends \Twig_Test_NodeTestCase
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
        $sTest = '<?php' . PHP_EOL . 'echo "test";' . PHP_EOL . '?>';

        $oBody = new \Twig_Node(array(new \Twig_Node_Text($sTest, 1)));
        $oNode = new \Twig\Node\GeshiNode($aParams, $oBody, 1, 'geshi');

        $this->assertEquals($oBody, $oNode->getNode('body'));
    }

    public function testGeshiPrepareBehavior()
    {
        $sBody = '   <?php' . PHP_EOL . 'echo "test";  ' . PHP_EOL . '?>  ';
        $sBodyPrepared = '<?php' . PHP_EOL . 'echo "test";  ' . PHP_EOL . '?>  ';

        ob_start();
        echo $sBody;
        $sContent = ob_get_clean();
        $aMatches = null;
        preg_match("/^\s*/", $sContent, $aMatches);
        $aLines = explode("\n", $sContent);
        $sContent = preg_replace('/^' . $aMatches[0] . '/', '', $aLines);
        $sContent = join("\n", $sContent);

        //Assert prepared content looks right
        $this->assertEquals($sBodyPrepared, $sContent);

        //Assert Geshi output
        $oEngine = new \Twig\Extension\GeshiEngine();

        $this->assertStringEqualsFile(__DIR__ . '/../../../_files/expected/prepare-behavior.html', $oEngine->transform($sContent, 'php'));
    }

    /**
     * Test that the generated code looks as expected
     *
     * @dataProvider getTests
     */
    public function testCompile($oNode, $source, $environment = null)
    {
        parent::testCompile($oNode, $source, $environment);
    }

    public function getTests()
    {
        $aTests = array();
        $aParams = array(
            'language' => 'php',
            'line_numbers' => false,
            'use_classes' => false,
            'class' => false,
            'id' => false
        );

        $oBody = new \Twig_Node(array(new \Twig_Node_Text('<?php' . PHP_EOL . 'echo "test";  ' . PHP_EOL . '?> ', 1)));
        $oNode = new \Twig\Node\GeshiNode($aParams, $oBody, 1, 'geshi');

        $aTests['simple_text'] = array($oNode, file_get_contents(__DIR__ . '/../../../_files/expected/simple-text.html'));

        $oBody = new \Twig_Node(array(new \Twig_Node_Text('<?php' . PHP_EOL . 'echo "test";' . PHP_EOL . '?>', 1)));
        $oNode = new \Twig\Node\GeshiNode($aParams, $oBody, 1, 'geshi');

        $aTests['text_with_leading_indent'] = array($oNode, file_get_contents(__DIR__ . '/../../../_files/expected/text-with-leading-indent.html'));

        return $aTests;
    }

}
