<?php
namespace Oxylion\HttpFoundation;

class Response
{
    public $headers = [];

    protected $content;
    protected $version;
    protected $statusCode;
    protected $statusText;

    protected $charset;

    public function __construct(?string $content='', int $status = 200, array $headers = [])
    {
        $this->headers = $headers;
        $this->setContent($content);
        $this->setStatusCode($status);
        $this->setProtocolVersion('1.0');
    }

    public function sendHeaders()
    {

    }

    public function sendContent()
    {
        echo $this->content;


        return $this;
    }

    public function send()
    {
        $this->sendHeaders();
        $this->sendContent();

        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        } elseif (!in_array(PHP_SAPI, ['cli', 'phpdbg'], true)) {
            static::closeOutputBuffers(0, true);
        }

        return $this;
    }


    public function setContent(?string $content)
    {
        $this->content = $content ?? '';


        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setStatusCode($status) {$this->statusCode = $status;}
    public function setProtocolVersion($semver='1.0') {$this->version = $semver;}

    /**
     * Cleans or flushes output buffers up to target level.
     *
     * Resulting level can be greater than target level if a non-removable buffer has been encountered.
     *
     * @final
     */
    public static function closeOutputBuffers(int $targetLevel, bool $flush): void
    {
        $status =ob_get_status(true);
        $level = count($status);
        $flags = PHP_OUTPUT_HANDLER_REMOVABLE | ($flush ? PHP_OUTPUT_HANDLER_FLUSHABLE : PHP_OUTPUT_HANDLER_CLEANABLE);

        while ($level-- > $targetLevel && ($s = $status[$level]) && (!isset($s['del']) ? !isset($s['flags']) || ($s['flags'] & $flags) === $flags : $s['del'])) {
            if ($flush) {
                ob_end_flush();
            } else {
                ob_end_clean();
            }
        }
    }


    public function redirect($url)
    {
        header("location: " . $url);
    }


}
