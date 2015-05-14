<?php

use Dafiti\Silex\Cache\Factory\Memcached;

class MemcachedTest extends \PHPUnit_Framework_TestCase
{
    private $factoryWithMemcachedInstalled;

    public function setUp()
    {
        $this->factoryWithMemcachedInstalled = $this->getMockBuilder('Dafiti\Silex\Cache\Factory\Memcached')
            ->disableOriginalConstructor()
            ->setMethods(['__construct'])
            ->getMock();

        return $this->factoryWithMemcachedInstalled;
    }

    /**
     * @expectedException \Dafiti\Silex\Exception\ModuleIsNotInstalled
     * @covers Dafiti\Silex\Cache\Factory\AbstractFactory::__construct
     */
    public function testCreateShouldThrowsModuleIsNotInstalled()
    {
        if (extension_loaded(Memcached::MODULE_NAME)) {
            $this->markTestSkipped('Memcached Module Is Installed');

            return;
        }

        new Memcached();
    }

    /**
     * @expectedException \Dafiti\Silex\Exception\InvalidCacheConfig
     * @covers Dafiti\Silex\Cache\Factory\Memcached::isValidParams
     * @covers Dafiti\Silex\Cache\Factory\Memcached::create
     */
    public function testCreateShouldThrowInvalidCacheConfig()
    {
        $params = [];

        $this->factoryWithMemcachedInstalled->create($params);
    }

    /**
     * @covers Dafiti\Silex\Cache\Factory\Memcached::create
     * @covers Dafiti\Silex\Cache\Factory\Memcached::isValidParams
     * @covers Dafiti\Silex\Cache\Factory\AbstractFactory::__construct
     */
    public function testCreateShouldReturnMemcachedInstance()
    {
        if (!extension_loaded(Memcached::MODULE_NAME)) {
            $this->markTestSkipped('Memcached Module Is Not Installed');

            return;
        }

        $params = [
            'host' => '127.0.0',
            'port' => 11211,
        ];

        $factory = new Memcached();

        $result = $factory->create($params);

        $this->assertInstanceOf('\Memcached', $result);
    }
}
