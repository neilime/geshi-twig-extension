<p align="center">
  <a href="https://neilime.github.io/geshi-twig-extension" target="_blank"><img src="https://repository-images.githubusercontent.com/19935239/628f1a00-eb4f-11e9-848a-0d9aa0369eee" width="400"></a>
  <h1 align="center">Geshi Twig Extension</h1>
</p>

[![Continuous Integration](https://github.com/neilime/geshi-twig-extension/actions/workflows/main-ci.yml/badge.svg)](https://github.com/neilime/geshi-twig-extension/actions/workflows/main-ci.yml)
[![codecov](https://codecov.io/gh/neilime/geshi-twig-extension/branch/main/graph/badge.svg?token=eMuwgNub7Z)](https://codecov.io/gh/neilime/geshi-twig-extension)
[![Latest Stable Version](https://poser.pugx.org/neilime/geshi-twig-extension/v/stable)](https://packagist.org/packages/neilime/geshi-twig-extension)
[![Total Downloads](https://poser.pugx.org/neilime/geshi-twig-extension/downloads)](https://packagist.org/packages/neilime/geshi-twig-extension)
[![License](https://poser.pugx.org/neilime/geshi-twig-extension/license)](https://packagist.org/packages/neilime/geshi-twig-extension)
[![Sponsor](https://img.shields.io/badge/%E2%9D%A4-Sponsor-ff69b4)](https://github.com/sponsors/neilime)

📢 **Geshi Twig Extension** is a [Twig](https://twig.symfony.com) extension for [GeSHi - Generic Syntax Highlighter rendering](https://github.com/GeSHi/geshi-1.0).

```twig
{{ '<?php\necho \'test\';\n?>' | geshi('php') }}
```

```twig
{% geshi 'javascript' %}
    {"data": "test"}
{% endgeshi %}
```

## Helping Project

❤️ If this project helps you reduce time to develop and/or you want to help the maintainer of this project. You can [sponsor](https://github.com/sponsors/neilime) him. Thank you !

## Contributing

👍 If you wish to contribute to this project, please read the [CONTRIBUTING.md](CONTRIBUTING.md) file. Note: If you want to contribute don't hesitate, I'll review any PR.

## Documentation

### [Installation](./docs/installation.md)

### [Usage](./docs/usage.md)

### [Development](./docs/development.md)

### [Code Coverage](https://codecov.io/gh/neilime/geshi-twig-extension)

### [PHP Doc](https://neilime.github.io/geshi-twig-extension/phpdoc)
