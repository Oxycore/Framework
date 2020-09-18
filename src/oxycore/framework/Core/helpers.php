<?php
if (!function_exists('include_exist')) {
    function include_exist(string $filePath) : bool
    {
        return file_exists($filePath) && include_once $filePath;
    }
}

if (!function_exists("bootLoader")){
    function bootLoader(): void
    {
        if(defined('BOOT_INIT')) {
            print "exit.";
            exit;
        }

        defined('BOOT_INIT') || define('BOOT_INIT', microtime(true));
        @define('ENVIRNOMENT', strtolower(substr(getenv('ENVIRNOMENT'), 0, 4)));
        if (substr(strtolower(getenv('DEBUG_CODE')), 0, 6)=="enable") {
            @define('DEBUG_MODE', true);
        }
        elseif (substr(strtolower(getenv('DEBUG_CODE')), 0, 7)=="disable"){
            @define('DEBUG_MODE', false);
        }
        @define('DS', DIRECTORY_SEPARATOR);
        @define('PS', PATH_SEPARATOR);

        @define('ROOTLINK', dirname(getcwd()));
        @define('ROOT_PATH', dirname(getcwd()));
        @define('APP_PATH', ROOTLINK . DS ."app");
        @define('BOOST_PATH', ROOTLINK . DS . "bootstrap");
        @define('PUBLIC_PATH', ROOTLINK . DS . "public");
        @define('SRC_PATH', ROOTLINK . DS . "src");
        @define('VENDOR_PATH', ROOTLINK . DS . "vendor");
    }
}

if (!function_exists("prt")) {
    function prt($array)
    {
        print "<pre>";
        print_r($array);
        print "</pre>";
    }
}

if (!function_exists("backtrace")) {
    function backtrace()
    {
        echo "<pre>";
        debug_print_backtrace();
        echo "</pre>";
    }
}

if (!function_exists("basepath")) {
    function basepath(): string
    {
        return getcwd();
    }
}


bootLoader();