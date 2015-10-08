<?php

namespace Dafiti\Silex;

use Dafiti\Silex\Exception\InvalidCacheConfig as InvalidCacheConfigException;
use Doctrine\Common\Cache\CacheProvider;
use Silex\ServiceProviderInterface;
use Silex\Application;

class CacheServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['cache.default_options'] = array(
            'adapter' => 'array',
        );

        $app['caches.options.initializer'] = $app->protect(function () use ($app) {
            static $initialized = false;

            if ($initialized) {
                return;
            }

            $initialized = true;

            if (!isset($app['caches.options'])) {
                $app['caches.options'] = array('default' => isset($app['cache.options']) ? $app['cache.options'] : array());
            }

            $tmp = $app['caches.options'];
            foreach ($tmp as $name => &$options) {
                $options = array_replace($app['cache.default_options'], $options);

                if (!isset($app['caches.default'])) {
                    $app['caches.default'] = $name;
                }
            }
            $app['caches.options'] = $tmp;
        });

        $app['caches'] = $app->share(function ($app) {
            $app['caches.options.initializer']();

            $caches = new \Pimple();
            foreach ($app['caches.options'] as $name => $options) {
                $caches[$name] = $caches->share(function ($caches) use ($options) {
                    $cacheClassName = sprintf('\Doctrine\Common\Cache\%sCache', $options['adapter']);            
                    if (!class_exists($cacheClassName)) {
                        throw new InvalidCacheConfigException('Cache Adapter ('.$options['adapter'].') Not Supported!');
                    }

                    $cacheAdapter = new $cacheClassName();
                    if ($options['connectable'] === true) {
                        $this->addConnection($cacheAdapter, $options);
                    }

                    return $cacheAdapter;
                });
            }

            return $caches;
        });

        // shortcuts for the "first" cache
        $app['cache'] = $app->share(function ($app) {
            $caches = $app['caches'];

            return $caches[$app['caches.default']];
        });
    }

    /**
     * @param CacheProvider $cacheAdapter
     * @param array         $cacheSettings
     */
    private function addConnection(CacheProvider $cacheAdapter, array $cacheSettings)
    {
        $proxy = new \Dafiti\Silex\Cache\Proxy();
        $connection = $proxy->getAdapter($cacheSettings);

        $setMethod = sprintf('set%s', $cacheSettings['adapter']);
        $cacheAdapter->$setMethod($connection);
    }

    public function boot(Application $app)
    {
    }
}
