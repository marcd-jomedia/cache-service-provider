<?php

namespace Dafiti\Silex;

use Silex\Application;

class CacheServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShouldThrowInvalidArgumentExceptionWhenConfigNotDefined()
    {
        $app = new Application();

        $app->register(new CacheServiceProvider());
        $cacheAdapter = $app['cache'];
    }

    /**
     * @expectedException \Dafiti\Silex\Exception\InvalidCacheConfig
     */
    public function testShouldThrowInvalidCacheConfigExceptionWhenCacheConfigNotDefined()
    {
        $app = new Application();

        $app['config'] = [];

        $app->register(new CacheServiceProvider());
        $cacheAdapter = $app['cache'];
    }

    /**
     * @expectedException \Dafiti\Silex\Exception\InvalidCacheConfig
     */
    public function testShouldThrowInvalidCacheConfigExceptionWhenAdapterNotExists()
    {
        $app = new Application();

        $app['config'] = [
            'cache' => [
                'adapter'       => 'CrazyMemcache',
                'host'          => '127.0.0.1',
                'port'          => 11211,
                'connectable'   => false
            ]
        ];

        $app->register(new CacheServiceProvider());
        $cacheAdapter = $app['cache'];
    }

    public function testShouldRegister()
    {
        $app = new Application();

        $app['config'] = [
            'cache' => [
                'adapter'            => 'Memcache',
                'host'               => '127.0.0',
                'port'               => 11211,
                'connectable'        => false
            ]
        ];

        $app->register(new CacheServiceProvider());

        $this->assertInstanceOf('\Doctrine\Common\Cache\CacheProvider', $app['cache']);
    }
}