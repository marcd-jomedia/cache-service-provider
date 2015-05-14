<?php

namespace Dafiti\Silex\Cache\Factory;

use Dafiti\Silex\Exception\InvalidCacheConfig;

class Memcached extends AbstractFactory
{
    const MODULE_NAME = 'memcached';

    public function getModuleName()
    {
        return self::MODULE_NAME;
    }

    public function create(array $params)
    {
        if (!$this->isValidatParams($params)) {
            throw new InvalidCacheConfig();
        }

        $memcached = new \Memcached();
        $memcached->addServer($params['host'], $params['port']);

        return $memcached;
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
