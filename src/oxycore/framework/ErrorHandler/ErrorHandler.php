<?php
namespace Oxycore\Framework\ErrorHandler;
use ErrorException;


class ErrorHandler
{
    public function register(self $error_handler = null)
    {
        set_error_handler([&$this, 'handleError']);
        set_exception_handler([&$this, 'handleException']);
    }

    public function handleError($errno, $errstr, $errfile, $errline)
    {

    }

    public function handleException(&$exception)
    {

    }

    public function handleErrorAsException($errno, $errstr, $errfile, $errline)
    {
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }

    public function handleFatalError() { }

}