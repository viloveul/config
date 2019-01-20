<?php

namespace Viloveul\Config\Contracts;

use Viloveul\Config\Contracts\Configuration;

interface ConfigFactory
{
    /**
     * @param string $filename
     */
    public static function load(string $filename): Configuration;
}
