# Solarium Service Provider
[![Build Status](https://img.shields.io/travis/dafiti/solarium-service-provider/master.svg?style=flat-square)](https://travis-ci.org/dafiti/solarium-service-provider)

A [Silex](https://github.com/silexphp/Silex) Service Provider for [Solarium](http://www.solarium-project.org).

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
