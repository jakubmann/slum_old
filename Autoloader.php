<?php
class Autoloader {
    public static function ClassLoader($className)
    {
        $path = 'classes/';
        require_once($path . $className . '.class.php');
    }
    public static function ViewLoader($className)
    {
        $path = 'view/';
        require_once($path . $className . '.php');
    }
}
