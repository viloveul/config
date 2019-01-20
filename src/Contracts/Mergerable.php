<?php

namespace Viloveul\Config\Contracts;

use Viloveul\Config\Contracts\Configuration;

interface Mergerable
{
    /**
     * @param Configuration $config
     * @param $overwrite
     */
    public function merge(Configuration $config, bool $overwrite = false): Configuration;
}
