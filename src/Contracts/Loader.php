<?php

namespace Viloveul\Config\Contracts;

use Viloveul\Config\Contracts\Configuration;

interface Loader
{
    /**
     * @param string $filename
     */
    public static function load(string $filename): Configuration;
}
