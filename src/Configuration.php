<?php

namespace Viloveul\Config;

use BadMethodCallException;
use Viloveul\Config\Contracts\Configuration as IConfiguration;
use Viloveul\Config\Contracts\Loader as ILoader;
use Viloveul\Config\IllegalException;
use Viloveul\Config\LoaderException;

class Configuration implements IConfiguration, ILoader
{
    /**
     * @var array
     */
    private $configs = [];

    /**
     * @param $key
     * @param $subs
     */
    public function __call($key, $subs)
    {
        if (strpos($key, 'get') === 0) {
            $key = strtolower(substr($key, 3, 1)) . substr($key, 4);
            if ($this->has($key)) {
                $sub = implode('.', $subs);
                $configs = $this->get($key);
                if (empty($sub) || array_key_exists($sub, $configs)) {
                    return $sub ? $configs[$sub] : $configs;
                }
            }
        }
        throw new BadMethodCallException("Config {$key} not found for direct call.");
    }

    /**
     * @param array $configs
     */
    public function __construct(array $configs = [])
    {
        $this->configs = $configs;
    }

    /**
     * @param  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * @param  $key
     * @return mixed
     */
    public function __isset($key)
    {
        return $this->has($key);
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * @return mixed
     */
    public function all(): array
    {
        return $this->configs;
    }

    /**
     * @param string     $key
     * @param $default
     */
    public function get(string $key, $default = null)
    {
        return $this->has($key) ? $this->configs[$key] : $default;
    }

    /**
     * @param string $key
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->configs);
    }

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
        return new static($configs);
    }

    /**
     * @param IConfiguration $config
     * @param bool           $overwrite
     */
    public function merge(IConfiguration $config, bool $overwrite = false): IConfiguration
    {
        $our = clone $this;
        foreach ($config->all() as $key => $value) {
            $our->set($key, $value, $overwrite);
        }
        return $our;
    }

    /**
     * @param  $key
     * @return mixed
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
     * @param  $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * @param $key
     * @param $value
     */
    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * @param $key
     */
    public function offsetUnset($key)
    {
        throw new IllegalException("Delete config is not allowed.");
    }

    /**
     * @param string   $key
     * @param $value
     * @param bool     $overwrite
     */
    public function set(string $key, $value = null, bool $overwrite = true): void
    {
        if ($overwrite === true || !$this->has($key)) {
            $this->configs[$key] = $value;
        }
    }
}
