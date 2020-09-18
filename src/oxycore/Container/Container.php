<?php
namespace Oxycore\Container;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    protected array $container;

    public function __construct($data)
    {
        $this->container =$data;
    }

    public function get($id)
    {
        return $this->container[$id];
    }

    public function has($id)
    {
        return isset($this->container[$id]);
    }
}