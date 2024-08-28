# Usage

## Features

### Filter support

#### Highlight PHP

```twig
{{ '<?php\necho \'test\';\n?>' | geshi('php') }}
```

#### Highlight PHP & use classes

```twig
{{ '<?php\necho \'test\';\n?>' | geshi('php', true) }}
```

### Tag support

#### Highlight Javascript :

```twig
{% geshi 'javascript' %}
    {"data": "test"}
{% endgeshi %}
```

#### Highlight Javascript & display line numbers & use classes :

```twig
{% geshi 'javascript' line_numbers use_classes %}
    {"data": "test"}
{% endgeshi %}
```
