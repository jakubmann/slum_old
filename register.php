<?php
require_once("Autoloader.php");

spl_autoload_register('Autoloader::ClassLoader');

$app = App::getInstance();

$app->run();
