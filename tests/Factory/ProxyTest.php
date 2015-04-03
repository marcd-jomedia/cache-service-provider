<?php


class ProxyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAdapterShouldReturnMemcachedInstance()
    {
        $proxy = new \Dafiti\Silex\Factory\Proxy();

        $params = [
            'adapter'     => 'Memcached',
            'host'        => '127.0.0.1',
            'port'        => 11211,
            'connectable' => false,
        ];

        $result = $proxy->getAdapter($params);
        $this->assertInstanceOf('\Memcached', $result);
    }

    public function testGetAdapterShouldReturnMemcacheInstance()
    {
        $proxy = new \Dafiti\Silex\Factory\Proxy();

        $params = [
            'adapter'     => 'Memcache',
            'host'        => '127.0.0.1',
            'port'        => 11211,
            'connectable' => false,
        ];

        $result = $proxy->getAdapter($params);
        $this->assertInstanceOf('\Memcache', $result);
    }

    public function testGetAdapterShouldReturnRedisInstance()
    {
        $proxy = new \Dafiti\Silex\Factory\Proxy();

        $params = [
            'adapter'     => 'Redis',
            'host'        => '127.0.0.1',
            'port'        => 11211,
            'connectable' => false,
        ];

        $result = $proxy->getAdapter($params);
        $this->assertInstanceOf('\Redis', $result);
    }
}
