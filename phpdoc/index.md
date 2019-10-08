## Table of contents

- [\Twig\Extension\GeshiExtension](#class-twigextensiongeshiextension)
- [\Twig\Node\GeshiNode](#class-twignodegeshinode)

<hr />

### Class: \Twig\Extension\GeshiExtension

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getFilters()</strong> : <em>array</em> |
| public | <strong>getName()</strong> : <em>string</em> |
| public | <strong>getTokenParsers()</strong> : <em>array</em> |
| public | <strong>parseGeshi(</strong><em>string</em> <strong>$sContent</strong>, <em>string</em> <strong>$sLanguage</strong>, <em>bool</em> <strong>$bUseClasses=false</strong>)</strong> : <em>string</em> |

*This class extends \Twig\Extension\AbstractExtension*

*This class implements \Twig\Extension\ExtensionInterface*

<hr />

### Class: \Twig\Node\GeshiNode

> Represents a Geshi node, it parses content as Geshi.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$aParams</strong>, <em>string</em> <strong>$sBody</strong>, <em>int</em> <strong>$iLine</strong>, <em>string</em> <strong>$sTag</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>compile(</strong><em>\Twig_Compiler</em> <strong>$oCompiler</strong>)</strong> : <em>void</em> |

*This class extends \Twig\Node\Node*

*This class implements \Traversable, \IteratorAggregate, \Countable*

