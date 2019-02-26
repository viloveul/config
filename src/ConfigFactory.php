<?php

namespace Viloveul\Config;

use Viloveul\Config\LoaderException;
use Viloveul\Config\Configuration;
use Viloveul\Config\Contracts\ConfigFactory as IConfigFactory;
use Viloveul\Config\Contracts\Configuration as IConfiguration;

class ConfigFactory implements IConfigFactory
{
    /**
     * @param string $filename
     */
    public static function load(string $filename): IConfiguration
    {
        if (!is_file($filename)) {
            throw new LoaderException("Filename does not exists.");
        }
        if (!is_readable($filename)) {
            throw new LoaderException("Filename is not readable.");
        }
        $configs = include $filename;
        return new Configuration($configs);
    }
}
