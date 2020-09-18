<?php
namespace Oxycore\Framework\HttpFoundation;

class Request
{
    protected string $request_uri;
    protected string $org_uri;
    protected string $path_info;
    protected array $_params;
    protected array $_request;
    protected array $_cookie;
    protected array $_files;
    protected array $_http_get;
    protected array $_http_post;


    public function __construct()
    {
        $this->parse_url();
        $this->parse_globals();
    }

    static public function createFromGlobals()
    {
        return new Request();
    }

    private function parse_url()
    {
        if(isset($_SERVER['PATH_INFO'])) {
            $this->org_uri = strval($_SERVER['PATH_INFO']);
        }
        elseif (isset($_SERVER['ORIG_PATH_INFO'])) {
            $this->org_uri = strval($_SERVER['ORIG_PATH_INFO']);
        }
        elseif (isset($_SERVER['REQUEST_URI'])) {
            $this->org_uri = strval($_SERVER['REQUEST_URI']);
        }
        else {
            $this->org_uri = "/";
        }

        $this->request_uri = urldecode(parse_url($this->org_uri, PHP_URL_PATH));

        $_path = ltrim($this->request_uri,'/');
        $path = rtrim($_path, '/');
        $this->path_info = $path;
        $this->_params = explode('/', $path);


        //$this->_request = $this->_params;
    }

    private function parse_globals()
    {
        $this->_cookie    = $_COOKIE;
        $this->_files     = $_FILES;
        $this->_http_get  = $_GET;
        $this->_http_post = $_POST;
    }

    /**
     * Attribute getters.
     */
    public function getURI()
    {
        return $this->org_uri;
    }
    public function getPathInfo(): string
    {
        return $this->path_info;
    }

    public function getParams(): array
    {
        return $this->_params;
    }

    public function getGlobalCookie(): array
    {
        return $this->_cookie;
    }

    public function getGlobalGet(): array
    {
        return $this->_http_get;
    }

    public function getGlobalPost(): array
    {
        return $this->_http_post;
    }

    public function getGlobalFile(): array
    {
        return $this->_files;
    }
}