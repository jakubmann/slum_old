<?php

require_once("../Autoloader.php");

spl_autoload_register('Autoloader::ClassLoader');

$app = App::getInstance();
$db = $app->getConn();

if ($_POST) {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  $password = md5($user_password);
}
