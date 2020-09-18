<?php
namespace Oxylion;

class bootstrap
{
    public static function init()
    {
        $components = ["Framework", "Foundation", "Support"];
        $path = dirname(__FILE__).DIRECTORY_SEPARATOR;
        $file = DIRECTORY_SEPARATOR."helpers.php";

        foreach ($components as $component)
            file_exists($path.$component.$file)? require_once $path.$component.$file : print nl2br("error: {$component}, not found.\n");
    }
}
