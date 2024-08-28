# Installation

## Install this library using composer

```bash
composer require geshi-twig-extension
```

## Register the extension in your Twig environment

```php
$twig->addExtension(new \Twig\Extension\GeshiExtension());
```

## Twig Token Parser

The Twig token parser provides the `geshi` tag :

```php
$twig->addTokenParser(new \Twig\TokenParser\GeshiTokenParser());
```
