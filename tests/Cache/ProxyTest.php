<?php

namespace Dafiti\Silex\Cache;

class ProxyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Dafiti\Silex\Cache\Proxy::getAdapter
     */
    public function testGetAdapterShouldReturnMemcachedInstance()
    {
        if (!extension_loaded(Factory\Memcached::MODULE_NAME)) {
            $this->markTestSkipped('Memcached Module Is Not Installed');

            return;
        }

        $proxy = new \Dafiti\Silex\Cache\Proxy();

        $params = [
            'adapter'     => 'Memcached',
            'host'        => '127.0.0.1',
            'port'        => 11211,
            'connectable' => false,
        ];

        $result = $proxy->getAdapter($params);
        $this->assertInstanceOf('\Memcached', $result);
    }

    /**
     * @covers Dafiti\Silex\Cache\Proxy::getAdapter
     */
    public function testGetAdapterShouldReturnMemcacheInstance()
    {
        if (!extension_loaded(Factory\Memcache::MODULE_NAME)) {
            $this->markTestSkipped('Memcache Module Is Not Installed');

            return;
        }
        $proxy = new \Dafiti\Silex\Cache\Proxy();

        $params = [
            'adapter'     => 'Memcache',
            'host'        => '127.0.0.1',
            'port'        => 11211,
            'connectable' => false,
        ];

        $result = $proxy->getAdapter($params);
        $this->assertInstanceOf('\Memcache', $result);
    }

    /**
     * @covers Dafiti\Silex\Cache\Proxy::getAdapter
     */
    public function testGetAdapterShouldReturnRedisInstance()
    {
        if (!extension_loaded(Factory\Redis::MODULE_NAME)) {
            $this->markTestSkipped('Redis Module Is Not Installed');

            return;
        }

        $proxy = new \Dafiti\Silex\Cache\Proxy();

        $params = [
            'adapter'     => 'Redis',
            'host'        => '127.0.0.1',
            'port'        => 11211,
            'connectable' => false,
        ];

        $result = $proxy->getAdapter($params);
        $this->assertInstanceOf('\Redis', $result);
    }

    /**
     * @covers Dafiti\Silex\Cache\Proxy::getAdapter
     * @expectedException \Dafiti\Silex\Exception\InvalidCacheConfig
     */
    public function testGetAdapterShouldThrowsInvalidCacheConfigWhenClassIsNotExists()
    {
        $proxy = new \Dafiti\Silex\Cache\Proxy();

        $params = [
            'adapter'     => 'Crazy',
            'host'        => '127.0.0.1',
            'port'        => 11211,
            'connectable' => false,
        ];

        $proxy->getAdapter($params);
    }
}
