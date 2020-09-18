<?php
namespace Oxylion\Config;

use Exception;

class Config
{
    private array $configs;
    private static ?Config $instance;

    public function __construct()
    {
        self::instance();
        $this->configs = include_exist(APP_PATH . "/config/configs.php");
    }

    public static function instance(): Config
    {
        if (self::$instance===null) {
            self::$instance = new Config();
        }

        return self::$instance;
    }

    public function __get($key)
    {
        return $this->configs[$key];
    }

    public function getAll(): array
    {
        return $this->configs;
    }

    public function __clone()
    {
        throw new Exception('Config is singleton - it cannot be cloned');
    }

    public function __wakeup()
    {
        throw new Exception('Config is singleton - it cannot be unserialized');
    }

    public function __unserialize(array $data)
    {
        throw new Exception('Config is singleton - it cannot be unserialized');
    }
}
