<?php
namespace Oxylion\Routing;

use Oxylion\HttpFoundation\Request;

class Router
{
    private array $config;

    private $controller;
    private $method;
    private array $params = [];

    private Request $request;
    private array $path_uri;

    public function __construct(Request $request)
    {
        $this->config = [
            'debug' => false
        ];

        $this->request = $request;
        $this->path_uri = $this->request->getParams();

        $this->controller = $this->path_uri[0];
        $this->method = $this->path_uri[1];

        for($i=2; $i<=count($this->path_uri)-1; $i++)
        {
            $this->params[$i-2] = $this->path_uri[$i];
            if($this->config['debug']) {
                $id = $i-2;
                print "param id: {$id},  [{$this->params[$id]}]<br/>";
            }
        }
    }

    public function get_controller(): string
    {
        return $this->controller;
    }

    public function get_method(): string
    {
        return $this->method;
    }

    public function get_params(): array
    {
        return $this->params;
    }

    public function getCluster(): array
    {
        return [];
    }

    public function get($id)
    {}
}
