<?php

namespace Dafiti\Silex\Cache\Factory;

use Dafiti\Silex\Exception\InvalidCacheConfig;
use Dafiti\Silex\Exception\ModuleIsNotInstalled;

class Memcache implements Factorable
{
    const MODULE_NAME = 'memcache';

    /**
     * @param array $params
     *
     * @return \Memcache
     *
     * @throws ModuleIsNotInstalled
     */
    public function create(array $params)
    {
        if (!extension_loaded(self::MODULE_NAME)) {
            throw new ModuleIsNotInstalled(self::MODULE_NAME);
        }

        if (!$this->isValidatParams($params)) {
            throw new InvalidCacheConfig();
        }

        $memcache = new \Memcache();
        $memcache->connect($params['host'], $params['port']);

        return $memcache;
    }

    /**
     * @param array $params
     *
     * @return bool
     */
    private function isValidatParams(array $params)
    {
        if (!isset($params['host'])) {
            return false;
        }

        if (!isset($params['port'])) {
            return false;
        }

        return true;
    }
}
