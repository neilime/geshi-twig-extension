---
layout: default
title: Home
---
Geshi Twig Extension
=======================

[![Build Status](https://travis-ci.org/neilime/geshi-twig-extension.png?branch=master)](https://travis-ci.org/neilime/geshi-twig-extension)
[![Coverage Status](https://coveralls.io/repos/github/neilime/geshi-twig-extension/badge.svg)](https://coveralls.io/github/neilime/geshi-twig-extension)
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
   * Highlight PHP :
   ```twig
   {{ '<?php
echo \'test\';
?>' | geshi('php') }}
   ```
   * Highlight PHP & use classes :
   ```twig
   {{ '<?php
echo \'test\';
?>' | geshi('php', true) }}
   ```

 * Tag support :
   * Highlight Javascript :
   ```twig
   {% raw %}{% geshi 'javascript' %}{% raw %}
       {"data": "test"}
   {% raw %}{% endgeshi %}{% raw %}
   ```
   * Highlight Javascript & display line numbers & use classes :
   ```twig
   {% raw %}{% geshi 'javascript' line_numbers use_classes %}{% raw %}
       {"data": "test"}
   {% raw %}{% endgeshi %}{% raw %}
   ```


Installation
------------

Add this project in via composer require :

```bash
$ composer require neilime/geshi-twig-extension
```

## Usage

### Twig Extension

The Twig extension provides the `geshi` tag and filter support.

Assumed that you are using  autoloading.

Adds the extension to the Twig environment:
```php
$twig->addExtension(new \Twigxtension\GeshiExtension());
```
### Twig Token Parser

The Twig token parser provides the `geshi` tag :
```php
$twig->addTokenParser(new \Twig\TokenParser\GeshiTokenParser());
```

[Code coverage](https://coveralls.io/github/neilime/geshi-twig-extension)
------------
