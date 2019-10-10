Geshi Twig Extension
=======================

[![Build Status](https://travis-ci.org/neilime/geshi-twig-extension.png?branch=master)](https://travis-ci.org/neilime/geshi-twig-extension)
[![Latest Stable Version](https://poser.pugx.org/neilime/geshi-twig-extension/v/stable.png)](https://packagist.org/packages/neilime/geshi-twig-extension)
[![Total Downloads](https://poser.pugx.org/neilime/geshi-twig-extension/downloads.png)](https://packagist.org/packages/neilime/geshi-twig-extension)

NOTE : If you want to contribute don't hesitate, I'll review any PR.

Introduction
------------

Twig extension for [GeSHi - Generic Syntax Highlighter rendering](http://qbnz.com/highlighter/index.php).

Contributing
------------

If you wish to contribute, please read both the [CONTRIBUTING.md](CONTRIBUTING.md) file.

Features
--------

 * Filter support :
   * Highlight PHP : `{{ "'<?php\necho \'test\';\n?>'|geshi('php') }}`
   * Highlight PHP & use classes : `{{ "'<?php\necho \'test\';\n?>'|geshi('php',true) }}`

 * Tag support :
   * Highlight Javascript : `{% geshi 'javascript' %}{"data": "test"}{% endgeshi %}`
   * Highlight Javascript & display line numbers & use classes : `{% geshi 'javascript' line_numbers use_classes %}{"data": "test"}{% endgeshi %}`


Installation
------------

Update your `composer.json`:

```json
{
  "require": {
        "neilime/geshi-twig-extension": "1.*"
    }
}
```

## Usage

### Twig Extension

The Twig extension provides the `geshi` tag and filter support.

Assumed that you are using [composer](http://getcomposer.org) autoloading.

Adds the extension to the Twig environment:
```php
$twig->addExtension(new \Twig\Extension\GeshiExtension());
```
### Twig Token Parser

The Twig token parser provides the `geshi` tag :
```php
$twig->addTokenParser(new \Twig\TokenParser\GeshiTokenParser());
```
