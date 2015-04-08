<?php

namespace Dafiti\Silex\Factory;

use Dafiti\Silex\Exception\InvalidCacheConfig;
use Dafiti\Silex\Exception\ModuleIsNotInstalled;

class Redis implements Factorable
{
    const MODULE_NAME = 'redis';

    public function create(array $params)
    {
        if (!extension_loaded(self::MODULE_NAME)) {
            throw new ModuleIsNotInstalled(self::MODULE_NAME);
        }

        if (!$this->isValidatParams($params)) {
            throw new InvalidCacheConfig();
        }

        $redis = new \Redis();
        $redis->connect($params['host'], $params['port']);

        return $redis;
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
