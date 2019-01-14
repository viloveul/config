<?php

namespace Viloveul\Config\Contracts;

use ArrayAccess;

interface Configuration extends ArrayAccess
{
    /**
     * @param $key
     * @param $subs
     */
    public function __call($key, $subs);

    /**
     * @param $key
     */
    public function __get($key);

    /**
     * @param $key
     */
    public function __isset($key);

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value);

    public function all(): array;

    /**
     * @param string     $key
     * @param $default
     */
    public function get(string $key, $default = null);

    /**
     * @param string $key
     */
    public function has(string $key): bool;

    /**
     * @param self         $config
     * @param $overwrite
     */
    public function merge(self $config, bool $overwrite = false): self;

    /**
     * @param $key
     * @param $value
     * @param $overwrite
     */
    public function set(string $key, $value = null, bool $overwrite = true): void;
}
