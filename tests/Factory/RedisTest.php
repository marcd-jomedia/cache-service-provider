<?php

use Dafiti\Silex\Factory\Redis;

class RedisTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Dafiti\Silex\Exception\InvalidCacheConfig
     */
    public function testCreateShouldThrowInvalidCacheConfig()
    {
        $params = [];

        $factory = new Redis();
        $factory->create($params);
    }

    public function testCreateShouldReturnRedisInstance()
    {
        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
        ];

        $factory = new Redis();
        $result = $factory->create($params);

        $this->assertInstanceOf('\Redis', $result);
    }
}
