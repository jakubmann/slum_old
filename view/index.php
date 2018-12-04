<?php
require_once("Autoloader.php");

spl_autoload_register('Autoloader::ClassLoader');


class index {
  private $app;

  public function __construct($app) {
    $this->app = $app;
  }
  public function render() {
    $posts = new Posts($this->app);
    $tpl = file_get_contents('template/posts.php');
    $tpl = str_replace('{\CONTENT}', $posts->render(2), $tpl);
    include('template/template.php');
  }
}
