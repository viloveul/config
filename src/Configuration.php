<?php

namespace Viloveul\Config;

use Viloveul\Config\IllegalException;
use Viloveul\Config\Contracts\Mergerable as IMergerable;
use Viloveul\Config\Contracts\Configuration as IConfiguration;

class Configuration implements IConfiguration, IMergerable
{
    /**
     * @var array
     */
    private $configs = [];

    /**
     * @param  $key
     * @param  $params
     * @return mixed
     */
    public function __call($key, $params)
    {
        $switcher = substr($key, 0, 3);
        $value = isset($params[0]) ? $params[0] : null;
        $name = lcfirst(substr($key, 3));
        switch ($switcher) {
            case 'set':
                $this->set($name, $value);
                break;
            case 'get':
                return $this->get($name, $value);
                break;
            default:
                throw new BadMethodCallException("method {$key} does not exists.");
                break;
        }
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
        return array_get($this->configs, $key, $default);
    }

    /**
     * @param string $key
     */
    public function has(string $key): bool
    {
        return array_has($this->configs, $key);
    }

    /**
     * @param IConfiguration $config
     * @param bool           $overwrite
     */
    public function merge(IConfiguration $config, bool $overwrite = false): IConfiguration
    {
        foreach ($config->all() as $key => $value) {
            $this->set($key, $value, $overwrite);
        }
        return $this;
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
