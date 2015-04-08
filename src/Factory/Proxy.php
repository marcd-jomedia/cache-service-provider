<?php

namespace Dafiti\Silex\Factory;

use Dafiti\Silex\Exception\InvalidCacheConfig;

class Proxy
{
    /**
     * @var Factorable
     */
    private $factory;

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function getAdapter(array $params)
    {
        $class = sprintf('\Dafiti\Silex\Factory\%s', $params['adapter']);
        if (!class_exists($class)) {
            throw new InvalidCacheConfig('');
        }
        $this->factory = new $class();

        return $this->factory->create($params);
    }
}
