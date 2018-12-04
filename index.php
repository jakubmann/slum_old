<?php

require_once("Autoloader.php");

spl_autoload_register('Autoloader::ClassLoader');

$app = App::getInstance();
$db = $app->getConn();

include_once('view/index.php');
$index = new index($app);
$index->render();
