<?php

namespace Twig\Node;

use InvalidArgumentException;
use Twig\Node\Node;
use Twig\Compiler;

/**
 * Represents a Geshi node, it parses content as Geshi.
 */
class GeshiNode extends Node
{
    /**
     * @param array<string,string|bool> $attributes
     * @param Node $body
     * @param int $lineno
     * @return void
     * @throws InvalidArgumentException
     */
    public function __construct(array $attributes, Node $body, int $lineno)
    {
        parent::__construct(
            nodes: ['body' => $body],
            attributes: $attributes,
            lineno: $lineno,
        );
    }

    public function compile(Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write('ob_start();' . PHP_EOL)
            ->subcompile($this->getNode('body'))
            ->write('$geshi = new \GeSHi(rtrim(ob_get_clean()), \'' . $this->getAttribute('language') . '\');' . PHP_EOL);

        if ($this->getAttribute('use_classes')) {
            $compiler->write('$geshi->enable_classes();' . PHP_EOL);
        }
        if ($this->getAttribute('line_numbers')) {
            $compiler->write('$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);' . PHP_EOL);
        }
        if ($this->getAttribute('class')) {
            $compiler->write('$geshi->set_overall_class(\'' . $this->getAttribute('class') . '\');' . PHP_EOL);
        }
        if ($this->getAttribute('id')) {
            $compiler->write('$geshi->set_overall_id(\'' . $this->getAttribute('id') . '\');' . PHP_EOL);
        }

        $compiler->write('echo $geshi->parse_code() . PHP_EOL;' . PHP_EOL);
    }
}
