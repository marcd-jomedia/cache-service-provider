# Solarium Service Provider
[![Build Status](https://img.shields.io/travis/pcelta/cache-service-provider/master.svg?style=flat-square)](https://travis-ci.org/pcelta/cache-service-provider)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/pcelta/cache-service-provider/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/pcelta/cache-service-provider/?branch=master)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/pcelta/cache-service-provider/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/pcelta/cache-service-provider/?branch=master)
[![HHVM](https://img.shields.io/hhvm/pcelta/cache-service-provider.svg)](https://travis-ci.org/pcelta/cache-service-provider)
[![Latest Stable Version](https://img.shields.io/packagist/v/pcelta/cache-service-provider.svg?style=flat-square)](https://packagist.org/packages/pcelta/cache-service-provider)
[![Total Downloads](https://img.shields.io/packagist/dt/pcelta/cache-service-provider.svg?style=flat-square)](https://packagist.org/packages/pcelta/cache-service-provider)
[![License](https://img.shields.io/packagist/l/pcelta/cache-service-provider.svg?style=flat-square)](https://packagist.org/packages/pcelta/cache-service-provider)

A [Silex](https://github.com/silexphp/Silex) Service Provider for [Doctrine Cache](https://github.com/doctrine/cache).

## Instalation

```json
{
    "require": {
        "dafiti/cache-service-provider": "dev-master"
    }
}
```

## Usage

```php

use Silex\Application;
use Dafiti\Silex\CacheServiceProvider;

$app = new Application();
$app['config'] = [
    'cache' => [
        'adapter'       => 'Memcache',
        'host'          => '127.0.0.1',
        'port'          => 11211,
        'connectable'   => true // If not need of one connection put FALSE
    ]
];

$app->register(new CacheServiceProvider());

$app['cache']->save('your-key', 'your-data');
$data = $app['cache']->fetch('your-key');

echo $data; // your-data

```

## License

MIT License
