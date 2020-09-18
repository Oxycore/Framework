<?php
namespace Oxycore\System;
use Oxycore\HttpFoundation\Request;
use Oxycore\HttpFoundation\Response;
use Oxycore\Routing\Router;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

abstract class ControllerAbstract
{
    const VIEW_FILE_EXT = ".html.twig";

    protected $view_filename = "base".self::VIEW_FILE_EXT;

    protected array $view_asset = [];

    protected Router $router;
    protected Request $request;
    protected Response $response;

    protected Environment $twig_view;
    protected FilesystemLoader $twig_loader;

    public string $controller = "";
    public string $method     = "";
    public array  $attributes = [];
    public array  $query      = [];

    protected $di;

    public function __construct($di = null)
    {
        if ($di!==null) {
            $this->di = $di;
        }
        //$this->controller = "home";
        //$this->method = "index";

        $this->request     = new Request();
        $this->router      = new Router($this->request);
        $this->response    = new Response();
        $this->twig_loader = new FilesystemLoader(ROOT_PATH.'/app/Resources/view/');
        $this->twig_view   = new Environment($this->twig_loader, ['debug'=>false]);
        $this->twig_loader->addPath(ROOT_PATH.'/src/WebSite/Resources/view/', "website");
    }

    public function __destruct()
    {
       $this->end();
    }


    public function end()
    {
        $this->response->send();
    }


    public function generateUrl()
    {
        echo 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
}