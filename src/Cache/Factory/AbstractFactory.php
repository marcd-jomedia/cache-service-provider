<?php

namespace Dafiti\Silex\Cache\Factory;

use Dafiti\Silex\Exception\ModuleIsNotInstalled;

abstract class AbstractFactory implements Factorable
{
    abstract public function getModuleName();

    public function __construct()
    {
        if (!$this->moduleIsInstalled()) {
            throw new ModuleIsNotInstalled($this->getModuleName());
        }
    }

    public function moduleIsInstalled()
    {
        if (!extension_loaded($this->getModuleName())) {
            return false;
        }

        return true;
    }
}
