# Официальный API клиент RUNET ID для PHP

## Установка

### PHP \>=5.5

`$ composer require guzzlehttp/psr7 php-http/guzzle6-adapter runet-id/api-client:^3.0@alpha`

### PHP 5.4

Пропишите вручную в `composer.json`:

```json
{
    "require": {
        "php-http/discovery": "dev-php54",
        "php-http/guzzle5-adapter": "dev-php54"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:ruvents/php-http-discovery.git"
        },
        {
            "type": "vcs",
            "url": "git@github.com:ruvents/php-http-guzzle5-adapter.git"
        }
    ],
    "config": {
        "platform": {
            "php": "5.4.0"
        }
    }
}
```

`$ composer require guzzlehttp/psr7 runet-id/api-client:^3.0@alpha`

### HTTP клиент

Вместо `php-http/guzzle(5|6)-adapter` вы можете использовать [любую имплементацию клиента](https://packagist.org/providers/php-http/client-implementation)

## Использование

### Без денормализации в объекты

```php
<?php

use RunetId\ApiClient\RunetIdClient;

$options = [
    'key' => 'key',
    'secret' => 'secret',
];

$client = new RunetIdClient($options);

$client->user()->get(1); //: array

$client->user()->get(1, [
    'language' => 'en',
    'event_id' => 123
]);
```

### С денормализацией

Для работы расширения необходимо установить пакет

`$ composer require symfony/serializer`

```php
<?php

use RunetId\ApiClient\RunetIdClient;
use RunetId\ApiClient\Extension\DenormalizationExtension;

$options = [
    'key' => 'key',
    'secret' => 'secret',
];

$extensions = [
    new DenormalizationExtension(),
];

$client = new RunetIdClient($options, $extensions);

$client->user()->get(1); //: User
```
