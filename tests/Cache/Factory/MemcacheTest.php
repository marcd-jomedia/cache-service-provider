<?php

use Dafiti\Silex\Cache\Factory\Memcache;

class MemcacheTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Dafiti\Silex\Exception\InvalidCacheConfig
     */
    public function testCreateShouldThrowInvalidCacheConfig()
    {
        $params = [];

        $factory = new \Dafiti\Silex\Cache\Factory\Memcache();
        $factory->create($params);
    }

    public function testCreateShouldReturnMemcacheInstance()
    {
        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
        ];

        $factory = new Memcache();
        $result = $factory->create($params);

        $this->assertInstanceOf('\Memcache', $result);
    }
}
