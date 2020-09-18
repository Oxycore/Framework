<?php
namespace Oxycore\Kernel;

use Oxycore\Config\Config;
use Oxycore\HttpFoundation\Request;
use Oxycore\HttpFoundation\Response;
use Oxycore\Routing\Router;
use Oxycore\System\ControllerAbstract;

abstract class KernelAbstract implements KernelInterface, TerminableInterface
{
    const ENV_DEVELOPMENT = "development";
    const ENV_PRODUCTION  = "production";
    const ENV_RELEASE     = "release";

    protected Config $config;
    protected Router $router;

    protected $bundles = [];

    protected $container;
    protected $envirnoment;
    protected $debug;
    protected $booted = false;
    protected $startTime;

    public ControllerAbstract $event_controller;
    public string $controller= "home";
    public string $method    = "index";
    public array $attributes = [];
    public array $query      = [];
    public $event;

    abstract public function handle(Request $request);


    public function __construct(string $envirnoment, bool $debug = false)
    {
        $this->envirnoment = strtolower($envirnoment);
        $this->debug = $debug;
    }

    public function boot()
    {
        if (true===$this->booted) {
            return;
        }

        if($this->debug || $this->config->profile) {
            $this->startTime = microtime(true);
            define('KERNEL_BOOT', microtime(true));
            define('KERNEL_BOOM', __FUNCTION__);
        }

        $this->config = new Config();

        $this->booted = true;
    }

    public function shutdown() { }
}