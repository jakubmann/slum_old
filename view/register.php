<?php
class register extends View {
  private $app;

  public function __construct($app) {
    $this->app = $app;
  }
  public function render() {
    $tpl = file_get_contents('template/register_form.php');
    if (strpos($_SERVER['PHP_SELF'], 'register')) {
      $header = '';
    }
    else {
      $header = $this->renderHeader();
    }
    echo str_replace('{/HEADER}', $header, str_replace('{/TPL}', $tpl, file_get_contents('template/template.php')));
  }
}
