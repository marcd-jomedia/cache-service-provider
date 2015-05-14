<?php

use Dafiti\Silex\Cache\Factory\Memcached;

class MemcachedTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Dafiti\Silex\Exception\InvalidCacheConfig
     */
    public function testCreateShouldThrowInvalidCacheConfig()
    {
        $params = [];

        $factory = new Memcached();
        $factory->create($params);
    }

    public function testCreateShouldReturnMemcachedInstance()
    {
        $params = [
            'host' => '127.0.0',
            'port' => 11211,
        ];

        $factory = new Memcached();
        $result = $factory->create($params);

        $this->assertInstanceOf('\Memcached', $result);
    }
}
