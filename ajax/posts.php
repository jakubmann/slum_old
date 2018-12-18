<?php
require_once("../Autoloader.php");
spl_autoload_register('Autoloader::ClassLoader');


$posts = new Posts(App::getInstance());

echo $posts->render($_POST['postCount']);
