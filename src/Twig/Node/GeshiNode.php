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
        $language = $this->getAttribute('language');
        if (!is_string($language) || $language === '') {
            throw new InvalidArgumentException('The "language" attribute must be a non-empty string.');
        }

        $compiler
            ->addDebugInfo($this)
            ->write('ob_start();' . PHP_EOL)
            ->subcompile($this->getNode('body'))
            ->write(sprintf(
                '$geshi = new \GeSHi(rtrim(ob_get_clean()), \'%s\');' . PHP_EOL,
                $language
            ));


        if ($this->getAttribute('use_classes')) {
            $compiler->write('$geshi->enable_classes();' . PHP_EOL);
        }

        if ($this->getAttribute('line_numbers')) {
            $compiler->write('$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);' . PHP_EOL);
        }

        $classAttribute = $this->getAttribute('class');
        if ($classAttribute) {
            if (!is_string($classAttribute)) {
                throw new InvalidArgumentException('The "class" attribute must be a string, got ' . gettype($classAttribute) . '.');
            }
            $compiler->write(
                sprintf(
                    '$geshi->set_overall_class(\'%s\');' . PHP_EOL,
                    $classAttribute
                )
            );
        }

        $idAttribute = $this->getAttribute('id');
        if ($idAttribute) {
            if (!is_string($idAttribute)) {
                throw new InvalidArgumentException('The "id" attribute must be a string, got ' . gettype($idAttribute) . '.');
            }
            $compiler->write(
                sprintf(
                    '$geshi->set_overall_id(\'%s\');' . PHP_EOL,
                    $idAttribute
                )
            );
        }

        $compiler->write('echo $geshi->parse_code() . PHP_EOL;' . PHP_EOL);
    }
}
