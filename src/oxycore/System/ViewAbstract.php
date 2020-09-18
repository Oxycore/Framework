<?php
namespace Oxycore\System;

abstract class ViewAbstract
{
    const RESOURCES_FILE = "base";
    const RESOURCES_VIEW_EXT = ".html.twig";
    const RESOURCES_PATH = APP_PATH."/Resources/view/";

    /**
     * @param string $name
     * @param string $path
     */
    public function renderHTML($name, $path='') {
        $path=self::RESOURCES_PATH.$path.$name.self::RESOURCES_VIEW_EXT;
        try {
            if(is_file($path)) {
                require $path;
            } else {
                throw new \Exception('Can not open template '.$name.' in: '.$path);
            }
        }
        catch(\Exception $e) {
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
    }

    /**
     * Display data JSON.
     * @param array $data Data container to display;
     */
    public function renderJSON($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Display data JSONP.
     * @param array $data Data container to display;
     */
    public function renderJSONP($data) {
        header('Content-Type: application/json');
        echo $_GET['callback'] . '(' . json_encode($data) . ')';
        exit();
    }

    /**
     * It sets data.
     *
     * @param string $name
     * @param mixed $value
     *
     * @return void
     */
    public function set($name, $value) {
        $this->$name=$value;
    }
    /**
     * It sets data.
     *
     * @param string $name
     * @param mixed $value
     *
     * @return void
     */
    public function __set($name, $value) {
        $this->$name=$value;
    }
    /**
     * It gets data.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get($name) {
        return $this->$name;
    }
    /**
     * It gets data.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name) {
        if( isset($this->$name) )
            return $this->$name;
        return null;
    }
}