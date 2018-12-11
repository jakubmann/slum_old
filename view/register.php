<?php
class register extends View {
  private $app;

  public function __construct($app) {
    $this->app = $app;
  }
  public function render() {
    $posts = new Posts($this->app);
    $tpl = file_get_contents('template/register_form.php');
    if (strpos($_SERVER['PHP_SELF'], 'register')) {
      $header = '';
    }
    else {
      $header = $this->renderHeader();
    }
    include('template/template.php');
  }
}
