<?php

use Dafiti\Silex\Cache\Factory;

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

        $factory = new \Dafiti\Silex\Cache\Factory\Memcache();
        $result = $factory->create($params);

        $this->assertInstanceOf('\Memcache', $result);
    }

    /**
     * @expectedException \Dafiti\Silex\Exception\ModuleIsNotInstalled
     */
    public function testCreateShouldThrowsModuleIsNotInstalled()
    {
        $factory = $this->getMockBuilder('Dafiti\Silex\Cache\Factory\Memcache')
            ->setMethods(['moduleIsInstalled'])
            ->getMock();

        $factory->expects($this->once())
            ->method('moduleIsInstalled')
            ->will($this->returnValue(false));

        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
        ];

        $factory->create($params);
    }
}
