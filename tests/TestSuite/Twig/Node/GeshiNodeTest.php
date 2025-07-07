<?php

namespace TestSuite\Twig\Node;

use InvalidArgumentException;
use Twig\Node\GeshiNode;
use Twig\Node\Node;
use Twig\Node\TextNode;
use Twig\Test\NodeTestCase;

class GeshiNodeTest extends NodeTestCase
{
    public function testConstructor()
    {
        $attributes = [
            'language' => 'php',
            'line_numbers' => false,
            'use_classes' => false,
            'class' => false,
            'id' => false,
        ];

        $test = '<?php' . PHP_EOL . 'echo "test";' . PHP_EOL . '?>';
        $body = new Node([new TextNode($test, 1)]);
        $node = new GeshiNode(
            attributes: $attributes,
            body: $body,
            lineno: 1,
        );

        $this->assertEquals($body, $node->getNode('body'));
    }

    public function getTests()
    {
        $tests = [];

        $test = '<?php' . PHP_EOL . 'echo "test";  ' . PHP_EOL . '?> ';
        $body = new Node([new TextNode($test, 1)]);
        $attributes = [
            'language' => 'php',
            'line_numbers' => true,
            'use_classes' => true,
            'class' => "test-class",
            'id' => "test-id",
        ];
        $node = new GeshiNode(
            attributes: $attributes,
            body: $body,
            lineno: 1,
        );

        $tests['simple_text'] = [
            $node,
            file_get_contents(__DIR__ . '/../../../_files/expected/simple-text.html'),
        ];

        $body = new Node([new TextNode($test, 1)]);
        $node = new GeshiNode(
            attributes: $attributes,
            body: $body,
            lineno: 1,
        );

        $compiler = $this->getCompiler(null);
        $compiler->compile($node);

        $tests['text_with_leading_indent'] = [
            $node,
            file_get_contents(__DIR__ . '/../../../_files/expected/text-with-leading-indent.html'),
        ];

        return $tests;
    }

    public function testCompileWithInvalidLanguage()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "language" attribute must be a non-empty string.');

        $attributes = [
            'language' => '',
            'line_numbers' => false,
            'use_classes' => false,
            'class' => false,
            'id' => false,
        ];
        $body = new Node([new TextNode('', 1)]);
        $node = new GeshiNode(
            attributes: $attributes,
            body: $body,
            lineno: 1,
        );

        $compiler = $this->getCompiler(null);
        $compiler->compile($node);
    }

    public function testCompileWithInvalidClassAttribute()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "class" attribute must be a string, got boolean.');

        $attributes = [
            'language' => 'php',
            'line_numbers' => false,
            'use_classes' => false,
            'class' => true,
            'id' => false,
        ];
        $body = new Node([new TextNode('', 1)]);
        $node = new GeshiNode(
            attributes: $attributes,
            body: $body,
            lineno: 1,
        );

        $compiler = $this->getCompiler(null);
        $compiler->compile($node);
    }

    public function testCompileWithInvalidIdAttribute()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "id" attribute must be a string, got boolean.');

        $attributes = [
            'language' => 'php',
            'line_numbers' => false,
            'use_classes' => false,
            'class' => false,
            'id' => true,
        ];
        $body = new Node([new TextNode('', 1)]);
        $node = new GeshiNode(
            attributes: $attributes,
            body: $body,
            lineno: 1,
        );

        $compiler = $this->getCompiler(null);
        $compiler->compile($node);
    }
}
