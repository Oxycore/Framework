<?php
namespace Oxylion\Framework;

class Framework
{
    const VERSION = '1.9.11';


    public function __construct() {}


    /**
     * Get version of using framework
     *
     * @return string
     */
    public function version()
    {
        return static::VERSION;
    }
}
