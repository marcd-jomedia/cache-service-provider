<?php

use Dafiti\Silex\Cache\Factory\Memcache;

class MemcacheTest extends \PHPUnit_Framework_TestCase
{
    private $factoryWithMemcacheInstalled;

    public function setUp()
    {
        $this->factoryWithMemcacheInstalled = $this->getMockBuilder('Dafiti\Silex\Cache\Factory\Memcache')
            ->disableOriginalConstructor()
            ->setMethods(['__construct'])
            ->getMock();

        return $this->factoryWithMemcacheInstalled;
    }
    /**
     * @expectedException \Dafiti\Silex\Exception\InvalidCacheConfig
     * @covers Dafiti\Silex\Cache\Factory\Memcache::create
     * @covers Dafiti\Silex\Cache\Factory\Memcache::isValidParams
     */
    public function testCreateShouldThrowInvalidCacheConfig()
    {
        $params = [];

        $this->factoryWithMemcacheInstalled->create($params);
    }

    /**
     * @covers Dafiti\Silex\Cache\Factory\Memcache::create
     * @covers Dafiti\Silex\Cache\Factory\Memcache::isValidParams
     */
    public function testCreateShouldReturnMemcacheInstance()
    {
        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
        ];

        $factory = new Memcache();
        if (!extension_loaded(Memcache::MODULE_NAME)) {
            $this->markTestSkipped('Memcache Module Is Not Installed');

            return;
        }

        $result = $factory->create($params);

        $this->assertInstanceOf('\Memcache', $result);
    }

    /**
     * @expectedException \Dafiti\Silex\Exception\ModuleIsNotInstalled
     * @covers Dafiti\Silex\Cache\Factory\Memcache::create
     */
    public function testCreateShouldThrowsModuleIsNotInstalled()
    {
        if (extension_loaded(Memcache::MODULE_NAME)) {
            $this->markTestSkipped('Memcache Module Is Installed');

            return;
        }

        new Memcache();
    }
}
