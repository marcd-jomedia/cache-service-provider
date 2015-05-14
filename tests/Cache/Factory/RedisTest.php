<?php

use Dafiti\Silex\Cache\Factory\Redis;

class RedisTest extends \PHPUnit_Framework_TestCase
{
    private $factoryWithRedisInstalled;

    public function setUp()
    {
        $this->factoryWithRedisInstalled = $this->getMockBuilder('Dafiti\Silex\Cache\Factory\Redis')
            ->disableOriginalConstructor()
            ->setMethods(['__construct'])
            ->getMock();

        return $this->factoryWithRedisInstalled;
    }
    /**
     * @expectedException \Dafiti\Silex\Exception\InvalidCacheConfig
     * @covers Dafiti\Silex\Cache\Factory\Redis::create
     * @covers Dafiti\Silex\Cache\Factory\Redis::isValidParams
     */
    public function testCreateShouldThrowInvalidCacheConfig()
    {
        $params = [];
        $this->factoryWithRedisInstalled->create($params);
    }

    /**
     * @covers Dafiti\Silex\Cache\Factory\Redis::create
     * @covers Dafiti\Silex\Cache\Factory\Redis::isValidParams
     * @covers Dafiti\Silex\Cache\Factory\AbstractFactory::__construct
     */
    public function testCreateShouldReturnRedisInstance()
    {
        if (!extension_loaded(Redis::MODULE_NAME)) {
            $this->markTestSkipped('Redis Module Is Not Installed');

            return;
        }

        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
        ];

        $factory = new Redis();
        $result = $factory->create($params);

        $this->assertInstanceOf('\Redis', $result);
    }
}
